<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Menampilkan semua data jenis.
     */
    public function index()
    {
        $jenis = Jenis::latest()->paginate(10);

        return view('jenis.index', compact('jenis'));
    }

    /**
     * Menampilkan form tambah jenis.
     */
    public function create()
    {
        return view('jenis.create');
    }

    /**
     * Menyimpan jenis baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis',
        ], [
            'nama_jenis.required' => 'Nama jenis wajib diisi.',
            'nama_jenis.unique' => 'Nama jenis sudah tersedia.',
        ]);

        Jenis::create([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()
            ->route('admin.jenis.index')
;
    }

    /**
     * Menampilkan detail jenis.
     */
    public function show(Jenis $jeni)
    {
        return view('jenis.show', compact('jeni'));
    }

    /**
     * Menampilkan form edit jenis.
     */
    public function edit(Jenis $jeni)
    {
        return view('jenis.edit', compact('jeni'));
    }

    /**
     * Mengupdate jenis.
     */
    public function update(Request $request, Jenis $jeni)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis,' . $jeni->id,
        ], [
            'nama_jenis.required' => 'Nama jenis wajib diisi.',
            'nama_jenis.unique' => 'Nama jenis sudah tersedia.',
        ]);

        $jeni->update([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()
            ->route('admin.jenis.index')
            ->with('success', 'Jenis berhasil diperbarui.');
    }

    /**
     * Menghapus jenis.
     */
    public function destroy(Jenis $jeni)
    {
        try {
            $jeni->delete();

            return redirect()
                ->route('admin.jenis.index')
                ->with('success', 'Jenis berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->route('admin.jenis.index')
                ->with('error', 'Jenis tidak dapat dihapus karena masih digunakan oleh produk.');
        }
    }
}