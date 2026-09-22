<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Jenis;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);
        $keyword = $request->input('search');

        $query = Produk::query();

        if ($keyword) {
            $query->where('nama', 'like', '%' . $keyword . '%')->orderBy('nama');
        } else {
            $query->latest();
        }

        $products = $query->with(['jenis', 'user'])->paginate(10)->withQueryString();

        return view('Produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $this->authorize('create', Produk::class);
    $produk = new Produk();
    $jenisList = Jenis::orderBy('nama_jenis')->get();

    return view('Produk.create', compact('produk', 'jenisList'));
}

public function edit(Produk $produk)
{
    $jenis = \App\Models\Jenis::orderBy('nama_jenis', 'asc')->get();

    return view('produk.edit', compact('produk', 'jenis'));
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);
        
        // Ambil data yang sudah lolos validasi dari StoreRequest
        $data = $request->validated();

        // Tambahkan user_id pembuat produk
        $data['user_id'] = Auth::id();

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        return view('Produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        // Ambil data ter-validasi dari UpdateRequest
        $data = $request->validated();

        // Jika upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */

public function destroy(Produk $produk)
{
    // Cek apakah produk masih digunakan pada transaksi
    $digunakan = \App\Models\ItemPenjualan::where('produk_id', $produk->id)->exists();

    if ($digunakan) {
        return redirect()
            ->route('admin.produk.index')
            ->with('error', 'Produk tidak dapat dihapus karena sudah digunakan dalam transaksi penjualan.');
    }

    // Hapus foto produk jika ada
    if ($produk->foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($produk->foto)) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($produk->foto);
    }

    // Hapus produk
    $produk->delete();

    return redirect()
        ->route('admin.produk.index')
        ->with('success', 'Produk berhasil dihapus.');
}
}