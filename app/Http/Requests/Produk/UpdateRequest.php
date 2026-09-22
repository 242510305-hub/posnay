<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama'       => 'required|string|max:255',
            'jenis_id'   => 'required|exists:jenis,id',
            'harga_beli' => 'required|integer|min:0',
            'harga_jual' => 'required|integer|min:0',
            'stok'       => 'required|integer|min:0',
        ];
    }

    /**
     * Custom validation error messages.
     */
    public function messages(): array
    {
        return [
            'foto.image'          => 'File yang diupload harus gambar.',
            'foto.mimes'          => 'Ekstensi gambar harus JPG, JPEG, atau PNG.',
            'foto.max'            => 'Maksimal ukuran gambar 2MB.',
            'nama.required'       => 'Nama produk wajib diisi.',
            'nama.string'         => 'Nama produk harus berupa teks.',
            'jenis_id.required'   => 'Jenis produk wajib dipilih.',
            'jenis_id.exists'     => 'Jenis produk yang dipilih tidak valid.',
            'harga_beli.required' => 'Harga pokok wajib diisi.',
            'harga_beli.integer'  => 'Harga pokok harus berupa angka/bilangan bulat.',
            'harga_beli.min'      => 'Harga pokok tidak boleh bernilai negatif.',
            'harga_jual.required' => 'Harga jual wajib diisi.',
            'harga_jual.integer'  => 'Harga jual harus berupa angka/bilangan bulat.',
            'harga_jual.min'      => 'Harga jual tidak boleh bernilai negatif.',
            'stok.required'       => 'Stok wajib diisi.',
            'stok.integer'        => 'Stok harus berupa angka/bilangan bulat.',
            'stok.min'            => 'Stok tidak boleh bernilai negatif.',
        ];
    }
}