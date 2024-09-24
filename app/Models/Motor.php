<?php

namespace App\Models;

use App\Models\Kendaraan;

class Motor extends Kendaraan
{
    protected $fillable = ['tahun_keluaran', 'warna', 'harga', 'mesin', 'tipe_suspensi', 'tipe_transmisi'];
}
