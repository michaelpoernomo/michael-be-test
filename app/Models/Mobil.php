<?php

namespace App\Models;

use App\Models\Kendaraan;

class Mobil extends Kendaraan
{
    protected $fillable = ['tahun_keluaran', 'warna', 'harga', 'mesin', 'kapasitas_penumpang', 'tipe'];
}
