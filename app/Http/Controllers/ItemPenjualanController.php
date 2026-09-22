<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * (Tambah produk ke keranjang)
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        try {
            DB::transaction(function () use ($request) {

                $sale = Penjualan::where('user_id', Auth::id())
                    ->where('status', 'OPEN')
                    ->firstOrFail();

                // lock produk supaya stok tidak race condition
                $product = Produk::where('id', $request->product_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($product->stok < $request->quantity) {
                    throw new \Exception('Stok produk tidak mencukupi');
                }

                $product->decrement('stok', $request->quantity);

                $item = ItemPenjualan::where('penjualan_id', $sale->id)
                    ->where('produk_id', $product->id)
                    ->lockForUpdate()
                    ->first();

                if ($item) {
                    // UPDATE qty kalau produk sudah ada di keranjang
                    $item->kuantitas += $request->quantity;
                } else {
                    // CREATE item baru
                    $item = new ItemPenjualan([
                        'penjualan_id' => $sale->id,
                        'produk_id'    => $product->id,
                        'kuantitas'    => $request->quantity,
                        'harga_satuan' => $product->harga_jual,
                    ]);
                }

                // hitung subtotal
                $item->subtotal = $item->kuantitas * $item->harga_satuan;
                $item->save();

                // update total pembayaran di penjualan
                $sale->total_pembayaran = $sale->itemPenjualan()->sum('subtotal');
                $sale->save();
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * (Tambah / kurangi kuantitas produk di keranjang)
     */
    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        $this->authorize('update', $itempenjualan);

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        try {
            DB::transaction(function () use ($request, $itempenjualan) {

                $produk = $itempenjualan->produk()->lockForUpdate()->first();

                $selisih = $request->quantity - $itempenjualan->kuantitas;

                // jika qty bertambah -> kurangi stok
                if ($selisih > 0) {
                    if ($produk->stok < $selisih) {
                        throw new \Exception('Stok tidak mencukupi');
                    }
                    $produk->decrement('stok', $selisih);
                }

                // jika qty berkurang -> kembalikan stok
                if ($selisih < 0) {
                    $produk->increment('stok', abs($selisih));
                }

                // update item
                $itempenjualan->update([
                    'kuantitas' => $request->quantity,
                    'subtotal'  => $request->quantity * $itempenjualan->harga_satuan
                ]);

                // update total pembayaran di penjualan
                $itempenjualan->penjualan->update([
                    'total_pembayaran' => $itempenjualan
                        ->penjualan
                        ->itemPenjualan()
                        ->sum('subtotal')
                ]);
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Kuantitas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     * (Hapus item dari keranjang)
     */
    public function destroy(ItemPenjualan $itempenjualan)
    {
        $this->authorize('delete', $itempenjualan);

        try {
            DB::transaction(function () use ($itempenjualan) {

                $produk = $itempenjualan->produk;
                $sale   = $itempenjualan->penjualan;

                // Kembalikan stok
                $produk->increment('stok', $itempenjualan->kuantitas);

                // Hapus item
                $itempenjualan->delete();

                // Update total penjualan
                $sale->update([
                    'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
                ]);
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}