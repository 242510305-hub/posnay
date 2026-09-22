<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $salesQuery = Penjualan::query()
            // Filter berdasarkan role
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // Search berdasarkan nama kasir
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            });

        $summary = [
            'total' => (clone $salesQuery)->count(),
            'completed' => (clone $salesQuery)->where('status', 'COMPLETED')->count(),
            'cash' => (clone $salesQuery)->where('metode_pembayaran', 'CASH')->count(),
            'non_cash' => (clone $salesQuery)->where('metode_pembayaran', 'QRIS')->count(),
        ];

        $sales = $salesQuery
            // Relasi user agar lebih efisien
            ->with('user.role')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales', 'summary'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%');
        })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $this->authorize('view', $penjualan);
        abort_if(strtoupper((string) $penjualan->status) !== 'COMPLETED', 404);

        $penjualan->load(['user', 'itemPenjualan.produk']);

        return view('penjualan.struk', ['sale' => $penjualan]);
    }

    public function barcode(Penjualan $penjualan)
    {
        $this->authorize('view', $penjualan);
        abort_if(strtoupper((string) $penjualan->status) !== 'COMPLETED', 404);

        return view('penjualan.barcode', ['sale' => $penjualan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        $this->authorize('view', $sale);
        abort_if($sale->status === 'COMPLETED', 403);

        $sale->load('itemPenjualan');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $this->authorize('view', $penjualan);

        $request->validate([
            'payment_method' => 'required|in:CASH,QRIS',
            'diskon' => 'required|integer|min:0',
            'uang_dibayar' => 'nullable|integer|min:0',
        ]);

        if ($penjualan->status != 'OPEN') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('error', 'Keranjang masih kosong. Tambahkan produk terlebih dahulu.');
        }

        $paymentMethod = $request->input('payment_method');
        $subtotal = (int) $penjualan->itemPenjualan()->sum('subtotal');
        $diskon = (int) $request->input('diskon', 0);

        if ($diskon > $subtotal) {
            return back()
                ->withInput()
                ->withErrors(['diskon' => 'Diskon tidak boleh lebih besar dari subtotal.']);
        }

        $total = $subtotal - $diskon;
        $uangDibayar = $paymentMethod === 'CASH'
            ? (int) $request->input('uang_dibayar', 0)
            : $total;

        if ($paymentMethod === 'CASH' && $uangDibayar < $total) {
            return back()
                ->withInput()
                ->withErrors(['uang_dibayar' => 'Uang dibayar harus minimal sebesar total pembayaran.']);
        }

        $kembalian = $uangDibayar - $total;

        DB::transaction(function () use ($penjualan, $paymentMethod, $subtotal, $diskon, $total, $uangDibayar, $kembalian) {
            // Hitung ulang total (anti manipulasi)
            $penjualan->update([
                'metode_pembayaran' => $paymentMethod,
                'diskon' => $diskon,
                'total_pembayaran' => $total,
                'uang_dibayar' => $uangDibayar,
                'kembalian' => $kembalian,
                'status' => 'COMPLETED'
            ]);
        });

        return redirect()
            ->route('admin.penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);

        // Pastikan hanya transaksi OPEN
        if ($penjualan->status != 'OPEN') {
            return redirect()->route('admin.penjualan.create')
                ->with('error', 'Transaksi sudah selesai tidak bisa dibatalkan');
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                // Kembalikan stok
                if ($item->produk) {
                    $item->produk->increment('stok', $item->kuantitas);
                }
            }

            // Hapus item
            $penjualan->itemPenjualan()->delete();

            // Hapus penjualan
            $penjualan->delete();
        });

        return redirect()
            ->route('admin.penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}