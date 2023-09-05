<?php

namespace App\Http\Controllers;

use App\Models\BahanMitra;
use App\Models\PengadaanBahan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengadaanBahanController extends Controller
{
    public function findOne(PengadaanBahan $pengadaanBahan)
    {
        return response()->json([
            'status' => true,
            'message' => 'data pengadaan bahan',
            'data' => $pengadaanBahan->load(['bahanMitra', 'status'])
        ]);
    }

    public function add(Request $request)
    {
        $data = [
            'bahan_mitra_id' => (int) $request['bahan_mitra_id'],
            'jumlah' => (int) $request['jumlah'],
            'total_harga' => (int) $request['total_harga'],
            'waktu_pengadaan' => $request['waktu_pengadaan'] ?  $request['waktu_pengadaan'] : now(),
            'waktu_diterima' => $request['waktu_diterima'] ? $request['waktu_diterima'] : null,
        ];
        $rules = [
            'bahan_mitra_id' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'status_pengiriman_id' => 'integer',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        $newPengadaanBahan = new PengadaanBahan($data);
        $newPengadaanBahan->save();

        return response()->json([
            'status' => true,
            'message' => 'tambah pengadaan bahan sukses',
            'data' => $newPengadaanBahan->load(['bahanMitra', 'status'])
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'bahan_mitra_id' => (int) $request['bahan_mitra_id'],
            'jumlah' => (int) $request['jumlah'],
            'total_harga' => (int) $request['total_harga'],
            'status_pengiriman_id' => (int) $request['status_pengiriman_id'] ? (int) $request['status_pengiriman_id'] : 1,
            'waktu_pengadaan' => $request['waktu_pengadaan'] ? $request['waktu_pengadaan'] : now(),
            'waktu_diterima' => $request['waktu_diterima'] ? $request['waktu_diterima'] : null,
        ];
        $rules = [
            'bahan_mitra_id' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'status_pengiriman_id' => 'integer',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        PengadaanBahan::where('id', $id)->update($data);
        $updatePengadaanBahan = PengadaanBahan::find($id);

        return response()->json([
            'status' => true,
            'message' => 'update pengadaan bahan sukses',
            'data' => $updatePengadaanBahan->load(['bahanMitra', 'status'])
        ], 201);
    }

    public function delete($id)
    {
        $isPengadaanBahan = PengadaanBahan::find($id);
        if (!$isPengadaanBahan) {
            return response()->json([
                'status' => false,
                'message' => 'data pengadaan bahan tidak ditemukan'
            ], 400);
        }
        PengadaanBahan::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'hapus pengadaan bahan berhasil, id pengadaan bahan = ' . $id
        ]);
    }

    public function reportPembelianPerusahaan()
    {
        $reportPembelianPerusahaan = PengadaanBahan::with(['bahanMitra', 'status'])->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'list data pembelian perusahaan',
            'data' => $reportPembelianPerusahaan
        ], 200);
    }
    public function reportPenjualanMitra(Request $request)
    {
        $reportPenjualanMitra = PengadaanBahan::with(['bahanMitra', 'status'])->where('mitra_id', $request->user()->id)->paginate(5);
        return response()->json([
            'status' => true,
            'message' => 'list data penjualan mitra',
            'data' => $reportPenjualanMitra
        ], 200);
    }
}
