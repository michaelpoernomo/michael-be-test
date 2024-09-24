<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    //
    public function index()
    {
        return response()->json(Kendaraan::all(), 200);
    }

    public function store(Request $request)
    {
        /**
         * test validasi
         * TODO: cek ulang
         */
        $data = $request->validate([
            'tahun_keluaran' => 'required',
            'warna' => 'required',
            'harga' => 'required',
        ]);

        $kendaraan = Kendaraan::create($data);

        return response()->json($kendaraan, 201);
    }
}
