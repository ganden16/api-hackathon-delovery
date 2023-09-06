<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function getAll()
    {
        $provinsi = Provinsi::all();
        return response()->json([
            'status' => true,
            'message' => 'list data provinsi',
            'data' => $provinsi
        ], 200);
    }

    public function findOne(Provinsi $provinsi)
    {
        return response()->json([
            'status' => true,
            'message' => 'data provinsi',
            'data' => $provinsi
        ], 200);
    }
}
