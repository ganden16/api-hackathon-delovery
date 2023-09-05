<?php

namespace App\Http\Controllers;

use App\Models\BahanMitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BahanMitraController extends Controller
{
    public function getAll()
    {
        $bahanMitra = BahanMitra::paginate(5);
        return response()->json([
            'status' => true,
            'message' => 'list data bahan mitra',
            'data' => $bahanMitra
        ], 200);
    }

    public function findOne(BahanMitra $bahanMitra)
    {
        return response()->json([
            'status' => true,
            'message' => 'data bahan mitra',
            'data' => $bahanMitra
        ]);
    }

    public function add(Request $request)
    {
        $data = [
            'nama' => $request['nama'],
            'mitra_id' => (int) $request['mitra_id'],
            'kategori_bahan_id' => (int) $request['kategori_bahan_id'],
            'status_penawaran' => (int) $request['status_penawaran'],
            'harga_satuan' => (int) $request['harga_satuan'] ? (int) $request['harga_satuan'] : null,
            'harga_kiloan' => (int) $request['harga'] ? (int) $request['harga'] : null,
            'gambar' => $request['gambar'] ? $request['gambar'] : null
        ];
        $rules = [
            'nama' => 'required',
            'mitra_id' => 'required',
            'kategori_bahan_id' => 'required',
            'status_penawaran' => 'required',
            'harga_satuan' => 'integer',
            'harga_kiloan' => 'integer',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        $newBahanMitra = new BahanMitra($data);
        $newBahanMitra->save();

        return response()->json([
            'status' => true,
            'message' => 'tambah bahan mitra sukses',
            'data' => $newBahanMitra
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama' => $request['nama'],
            'mitra_id' => (int) $request['mitra_id'],
            'kategori_bahan_id' => (int) $request['kategori_bahan_id'],
            'status_penawaran' => (int) $request['status_penawaran'],
            'harga_satuan' => (int) $request['harga_satuan'] ? (int) $request['harga_satuan'] : null,
            'harga_kiloan' => (int) $request['harga_kiloan'] ? (int) $request['harga_kiloan'] : null,
            'gambar' => $request['gambar'] ? $request['gambar'] : null
        ];
        $rules = [
            'nama' => 'required',
            'mitra_id' => 'required',
            'kategori_bahan_id' => 'required',
            'status_penawaran' => 'required',
            'harga_satuan' => 'integer',
            'harga_kiloan' => 'integer',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        BahanMitra::where('id', $id)->update($data);
        $newBahanMitra = BahanMitra::find($id);
        return response()->json([
            'status' => true,
            'message' => 'update bahan mitra sukses',
            'data' => $newBahanMitra
        ], 201);
    }

    public function delete($id)
    {
        $isBahanMitra = BahanMitra::find($id);
        if (!$isBahanMitra) {
            return response()->json([
                'status' => false,
                'message' => 'data bahan mitra tidak ditemukan'
            ], 400);
        }
        BahanMitra::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'hapus bahan mitra berhasil, id bahan mitra = ' . $id
        ]);
    }
}
