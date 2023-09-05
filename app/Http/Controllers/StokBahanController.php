<?php

namespace App\Http\Controllers;

use App\Models\StokBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StokBahanController extends Controller
{
    public function getAll()
    {
        $stokBahan = StokBahan::with('kategoriBahan')->paginate(5);
        return response()->json([
            'status' => true,
            'message' => 'list data stok bahan',
            'data' => $stokBahan
        ], 200);
    }

    public function findOne(StokBahan $stokBahan)
    {
        return response()->json([
            'status' => true,
            'message' => 'data stok bahan',
            'data' => $stokBahan->load('kategoriBahan')
        ]);
    }

    public function add(Request $request)
    {
        $data = [
            'nama' => $request['nama'],
            'mitra_id' => (int) $request['mitra_id'],
            'kategori_bahan_id' => (int) $request['kategori_bahan_id'],
            'total_satuan' => (int) $request['total_satuan'] ? (int) $request['total_satuan'] : null,
            'total_berat' => (int) $request['total_berat'] ? (int) $request['total_berat'] : null,
            'gambar' => $request['gambar'] ? $request['gambar'] : null

        ];
        $rules = [
            'nama' => 'required',
            'mitra_id' => 'required',
            'kategori_bahan_id' => 'required',
            'total_satuan' => 'integer',
            'total_berat' => 'integer',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        $newStokBahan = new StokBahan($data);
        $newStokBahan->save();

        return response()->json([
            'status' => true,
            'message' => 'tambah stok bahan sukses',
            'data' => $newStokBahan
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'nama' => $request['nama'],
            'mitra_id' => (int) $request['mitra_id'],
            'kategori_bahan_id' => (int) $request['kategori_bahan_id'],
            'total_satuan' => (int) $request['total_satuan'] ? (int) $request['total_satuan'] : null,
            'total_berat' => (int) $request['total_berat'] ? (int) $request['total_berat'] : null,
            'gambar' => $request['gambar'] ? $request['gambar'] : null

        ];
        $rules = [
            'nama' => 'required',
            'mitra_id' => 'required',
            'kategori_bahan_id' => 'required',
            'total_satuan' => 'integer',
            'total_berat' => 'integer',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        StokBahan::where('id', $id)->update($data);
        $stokBahan = StokBahan::find($id);

        return response()->json([
            'status' => true,
            'message' => 'update stok bahan sukses',
            'data' => $stokBahan
        ], 201);
    }

    public function delete($id)
    {
        $isStokBahan = StokBahan::find($id);
        if (!$isStokBahan) {
            return response()->json([
                'status' => false,
                'message' => 'data stok bahan tidak ditemukan'
            ], 400);
        }
        StokBahan::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'hapus stok bahan berhasil, id stok bahan = ' . $id
        ]);
    }
}
