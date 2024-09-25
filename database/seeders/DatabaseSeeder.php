<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;
use App\Enums\KendaraanJenis;
use App\Enums\KendaraanStatus;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'jenis' => KendaraanJenis::MOBIL->value,
                'tahun_keluaran' => 2024,
                'warna' => 'hitam',
                'harga' => 20000,
                'status' => KendaraanStatus::TERJUAL->value,
                'mesin' => 'mesin 1',
                'kapasitas_penumpang' => 6,
                'tipe' => 'tipe mobil 1',
            ],
            [
                'jenis' => KendaraanJenis::MOBIL->value,
                'tahun_keluaran' => 2022,
                'warna' => 'putih',
                'harga' => 15000,
                'status' => KendaraanStatus::TERSEDIA->value,
                'mesin' => 'mesin 2',
                'kapasitas_penumpang' => 4,
                'tipe' => 'tipe mobil 2',
            ],
            [
                'jenis' => KendaraanJenis::MOTOR->value,
                'tahun_keluaran' => 1998,
                'warna' => 'hijau',
                'harga' => 10000,
                'status' => KendaraanStatus::TERJUAL->value,
                'mesin' => 'mesin 3',
                'tipe_suspensi' => 'suspensi motor 1',
                'tipe_transmisi' => 'suspensi motor 1',
            ],
            [
                'jenis' => KendaraanJenis::MOTOR->value,
                'tahun_keluaran' => 1995,
                'warna' => 'kuning',
                'harga' => 5000,
                'status' => KendaraanStatus::TERSEDIA->value,
                'mesin' => 'mesin 4',
                'tipe_suspensi' => 'suspensi motor 2',
                'tipe_transmisi' => 'suspensi motor 2',
            ],
        ];
        Kendaraan::insert($data);
    }
}
