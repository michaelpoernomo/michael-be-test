<?php

namespace App\Models;

use App\Models\Kendaraan;

class Mobil extends Kendaraan
{
    protected $fillable = [
        'jenis', 'tahun_keluaran', 'warna', 'harga', 'status',
        'mesin', 'kapasitas_penumpang', 'tipe'
    ];

    public function getValidator(): array
    {
        return [
            'mesin' => 'required|string',
            'kapasitas_penumpang' => 'required|int',
            'tipe' => 'required|string',
        ];
    }
}
