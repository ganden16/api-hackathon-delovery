<?php

namespace App\Http\Controllers;

use App\Models\KategoriBahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriBahanController extends Controller
{
    public function getAll()
    {
        $kategoriBahan = KategoriBahan::paginate(5);

        return response()->json([
            'status' => true,
            'message' => 'list data kategori bahan',
            'data' => $kategoriBahan
        ], 200);
    }

    public function findOne(KategoriBahan $kategoriBahan)
    {
        return response()->json([
            'status' => true,
            'message' => 'data kategori bahan',
            'data' => $kategoriBahan
        ]);
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

        $newKategoriBahan = new KategoriBahan($data);
        $newKategoriBahan->save();

        return response()->json([
            'status' => true,
            'message' => 'tambah kategori bahan sukses',
            'data' => $newKategoriBahan
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

        KategoriBahan::where('id', $id)->update($data);

        return response()->json([
            'status' => true,
            'message' => 'update kategori bahan sukses',
            'data' => KategoriBahan::find($id)
        ], 200);
    }

    public function delete($id)
    {
        $isKategoriBahan = KategoriBahan::find($id);
        if (!$isKategoriBahan) {
            return response()->json([
                'status' => false,
                'message' => 'data kategori bahan tidak ditemukan'
            ], 400);
        }
        KategoriBahan::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'hapus kategori bahan berhasil, id kategori bahan = ' . $id
        ]);
    }
}
