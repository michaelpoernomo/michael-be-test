<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KendaraanService;

class KendaraanController extends Controller
{
    protected $kendaraanService;

    public function __construct(KendaraanService $kendaraanService)
    {
        $this->kendaraanService = $kendaraanService;
    }

    public function terjual()
    {
        return response()->json($this->kendaraanService->getAllSold(), 200);
    }

    public function tersedia()
    {
        return response()->json($this->kendaraanService->getAllInStock(), 200);
    }

    public function penjualan($jenis)
    {
        return response()->json($this->kendaraanService->getSoldByJenis($jenis), 200);
    }
    
    public function tambah(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'jenis' => 'required',
        ]);
        if ($validator->fails()) {
            throw new \Exception($validator->errors());
        }
        $kendaraan = $this->kendaraanService->create($request['jenis'], $request->all());
        return response()->json($kendaraan, 201);
    }

    public function hapusSemua() 
    {
        $this->kendaraanService->deleteAll();
        return response()->json(['message' => 'All vehicles deleted successfully.'], 202);
    }

    public function laporan()
    {
        $laporan = $this->kendaraanService->laporanPenjualan();
        return response()->json($laporan, 200);
    }
}

