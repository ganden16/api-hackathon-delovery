<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriProdukController extends Controller
{
    public function getAll(Request $request)
    {
        $kategoriproduk = KategoriProduk::paginate(5);

        return response()->json([
            'status' => true,
            'message' => 'list data kategori produk',
            'data' => $kategoriproduk
        ], 200);
    }

    public function findOne(KategoriProduk $kategoriProduk)
    {
        return response()->json([
            'status' => true,
            'message' => 'data kategori produk',
            'data' => $kategoriProduk
        ], 200);
    }

    public function add(Request $request)
    {
        $data = [
            'nama' => $request['nama'],
        ];
        $rules = [
            'nama' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        $newKategoriProduk = new KategoriProduk($data);
        $newKategoriProduk->save();

        return response()->json([
            'status' => true,
            'message' => 'tambah kategori produk sukses',
            'data' => $newKategoriProduk
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama' => $request['nama'],
        ];
        $rules = [
            'nama' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        KategoriProduk::where('id', $id)->update($data);

        return response()->json([
            'status' => true,
            'message' => 'update kategori produk sukses',
            'data' => KategoriProduk::find($id)
        ], 200);
    }

    public function delete($id)
    {
        $isKategoriProduct = KategoriProduk::find($id);
        if (!$isKategoriProduct) {
            return response()->json([
                'status' => false,
                'message' => 'data kategori produk tidak ditemukan'
            ], 400);
        }
        KategoriProduk::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'hapus kategori produk berhasil, id kategori bahan = ' . $id
        ]);
    }
}
