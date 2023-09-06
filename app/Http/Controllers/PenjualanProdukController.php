<?php

namespace App\Http\Controllers;

use App\Models\PenjualanProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanProdukController extends Controller
{
    public function findOne(PenjualanProduk $penjualanProduk)
    {
        return response()->json([
            'status' => true,
            'message' => 'data penjualan produk',
            'data' => $penjualanProduk->load(['produk', 'status', 'pelanggan', 'kota'])
        ]);
    }

    public function add(Request $request)
    {
        $data = [
            'produk_id' => (int) $request['produk_id'],
            'pelanggan_id' => $request->user()->id,
            'nama_pembeli' =>  $request['nama_pembeli'],
            'alamat_pengiriman' =>  $request['alamat_pengiriman'],
            'kode_pos_pengiriman' =>  $request['kode_pos_pengiriman'],
            'kota_id' =>  $request['kota_id'],
            'jumlah' => (int) $request['jumlah'],
            'total_harga' => (int) $request['total_harga'],
            'waktu_penjualan' => $request['waktu_penjualan'] ? $request['waktu_penjualan'] :  now(),
            'waktu_diterima' => $request['waktu_diterima'] ? $request['waktu_diterima'] : null,
        ];
        $rules = [
            'produk_id' => 'required',
            'pelanggan_id' => 'required',
            'nama_pembeli' =>  'required',
            'alamat_pengiriman' =>  'required',
            'kota_id' =>  'required',
            'kode_pos_pengiriman' =>  'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        $newPenjualanProduk = new PenjualanProduk($data);
        $newPenjualanProduk->save();

        return response()->json([
            'status' => true,
            'message' => 'order sukses',
            'data' => $newPenjualanProduk->load(['produk', 'status', 'pelanggan', 'kota'])
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'produk_id' => (int) $request['produk_id'],
            'pelanggan_id' => $request->user()->id,
            'status_pengiriman_id' => (int) $request['status_pengiriman_id'] ? (int) $request['status_pengiriman_id'] : 1,
            'nama_pembeli' =>  $request['nama_pembeli'],
            'alamat_pengiriman' =>  $request['alamat_pengiriman'],
            'kode_pos_pengiriman' =>  $request['kode_pos_pengiriman'],
            'kota_id' =>  $request['kota_id'],
            'jumlah' => (int) $request['jumlah'],
            'total_harga' => (int) $request['total_harga'],
            'waktu_diterima' => $request['waktu_diterima'] ? $request['waktu_diterima'] : null,
        ];
        $rules = [
            'produk_id' => 'required',
            'pelanggan_id' => 'required',
            'nama_pembeli' =>  'required',
            'alamat_pengiriman' =>  'required',
            'kode_pos_pengiriman' =>  'required',
            'kota_id' =>  'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
        ];

        $validator = Validator::make($data, $rules);
        $validator->validate();

        PenjualanProduk::where('id', $id)->update($data);
        $newPenjualanProduk = PenjualanProduk::find($id);
        return response()->json([
            'status' => true,
            'message' => 'update order sukses',
            'data' => $newPenjualanProduk->load(['produk', 'status', 'pelanggan', 'kota'])
        ], 200);
    }

    public function delete($id)
    {
        $isOrder = PenjualanProduk::find($id);
        if (!$isOrder) {
            return response()->json([
                'status' => false,
                'message' => 'data order produk tidak ditemukan'
            ], 400);
        }
        PenjualanProduk::destroy($id);
        return response()->json([
            'status' => true,
            'message' => 'hapus order produk berhasil, id order produk = ' . $id
        ]);
    }

    public function reportPembelianPelanggan(Request $request)
    {
        $pembelianProduk = PenjualanProduk::with(['produk', 'status', 'kota'])->where('pelanggan_id', $request->user()->id)->paginate(5);
        return response()->json([
            'status' => true,
            'message' => 'list data pembelian produk',
            'data' => $pembelianProduk
        ], 200);
    }
    public function reportPenjualanPerusahaan()
    {
        $penjualanProduk = PenjualanProduk::with(['produk', 'status', 'pelanggan', 'kota'])->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'list data penjualan produk',
            'data' => $penjualanProduk
        ], 200);
    }
}
