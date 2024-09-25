<?php

namespace App\Models;

use App\Models\Kendaraan;

class Motor extends Kendaraan
{
    protected $fillable = [
        'jenis', 'tahun_keluaran', 'warna', 'harga', 'status',
        'mesin', 'tipe_suspensi', 'tipe_transmisi'
    ];

    public function getValidator(): array
    {
        return [
            'mesin' => 'required|string',
            'tipe_suspensi' => 'required|string',
            'tipe_transmisi' => 'required|string',
        ];
    }
}
