<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Kendaraan extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'kendaraans';
    protected $fillable = ['tahun_keluaran', 'warna', 'harga'];
}
