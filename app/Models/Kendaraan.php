<?php

namespace App\Models;

use App\Enums\KendaraanJenis;
use App\Enums\KendaraanStatus;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Kendaraan extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'kendaraans';
    protected $fillable = [
        'jenis', 'tahun_keluaran', 'warna', 'harga', 'status',
    ];

    public function getValidator(): array
    {
        return [
            'jenis' => 'required|string|in:' . KendaraanJenis::allValuesValidator(),
            'tahun_keluaran' => 'required|int',
            'warna' => 'required|string',
            'harga' => 'required|int',
            'status' => 'required|string|in:' . KendaraanStatus::allValuesValidator(),
        ];
    }
}
