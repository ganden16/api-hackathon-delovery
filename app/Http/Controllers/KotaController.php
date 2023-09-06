<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function getAll()
    {
        $kota = Kota::with('provinsi')->get();
        return response()->json([
            'status' => true,
            'message' => 'list data kota',
            'data' => $kota
        ], 200);
    }

    public function findOne(Kota $kota)
    {
        return response()->json([
            'status' => true,
            'message' => 'data kota',
            'data' => $kota
        ], 200);
    }
}
