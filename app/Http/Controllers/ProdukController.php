<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function getAll(Request $request)
    {
        if ($request['kota']) {
            $produk = Kota::with('produk')->where('id', (int)$request['kota'])->paginate(10);
        } elseif ($request['kategori']) {
            $produk = Produk::where('kategori_produk_id', (int)$request['kategori'])->paginate(10);
        } else {
            $produk = Produk::paginate(10);
        }
        return response()->json([
            'status' => true,
            'message' => 'list data produk',
            'data' => $produk
        ], 200);
    }

    public function findOne(Produk $produk)
    {
        return response()->json([
            'status' => true,
            'message' => 'data produk',
            'data' => $produk->load('kategoriProduk')
        ]);
    }

    public function add(Request $request)
    {
        $data = [
            'nama' => $request['nama'],
            'kategori_produk_id' => (int) $request['kategori_produk_id'],
            'harga' => (int) $request['harga'],
            'jumlah_stok' => (int) $request['jumlah_stok'],
            'gambar' => $request['gambar'] ? $request['gambar'] : null
        ];
        $rules = [
            'nama' => 'required',
            'kategori_produk_id' => 'required|numeric',
            'harga' => 'required',
            'jumlah_stok' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        $newProduct = new Produk($data);
        $newProduct->save();

        return response()->json([
            'status' => true,
            'message' => 'tambah produk sukses',
            'data' => $newProduct->load('kategoriProduk')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama' => $request['nama'],
            'kategori_produk_id' => (int) $request['kategori_produk_id'],
            'harga' => (int) $request['harga'],
            'jumlah_stok' => (int) $request['jumlah_stok'],
            'gambar' => $request['gambar'] ? $request['gambar'] : null
        ];
        $rules = [
            'nama' => 'required',
            'kategori_produk_id' => 'required|numeric',
            'harga' => 'required',
            'jumlah_stok' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        Produk::where('id', $id)->update($data);

        return response()->json([
            'status' => true,
            'message' => 'update produk sukses',
            'data' => Produk::find($id)->load('kategoriProduk')
        ], 200);
    }

    public function delete($id)
    {
        $isProduk = Produk::find($id);
        if (!$isProduk) {
            return response()->json([
                'status' => false,
                'message' => 'data produk tidak ditemukan'
            ], 400);
        }
        Produk::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'hapus produk berhasil, id produk = ' . $id
        ]);
    }
}
