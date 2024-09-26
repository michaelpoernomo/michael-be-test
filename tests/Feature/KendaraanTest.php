<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Kendaraan;
use App\Enums\KendaraanJenis;
use App\Enums\KendaraanStatus;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class KendaraanTest extends TestCase
{
    use DatabaseMigrations;

    protected $test_data = [
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
            'jenis' => KendaraanJenis::MOBIL->value,
            'tahun_keluaran' => 2022,
            'warna' => 'putih',
            'harga' => 15000,
            'status' => KendaraanStatus::TERJUAL->value,
            'mesin' => 'mesin 2',
            'kapasitas_penumpang' => 4,
            'tipe' => 'tipe mobil 2',
        ],
    ];

    protected function getToken(): string
    {
        User::factory()->create();
        $response = $this->postJson('/api/get_token', [
            'email' => 'test@mail.com',
            'password' => 'test',
        ]);
        return $response->json('token');
    }

    protected function createKendaraan(string $token, array $test_data): string
    {
        // create data
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
                        ->postJson('/api/kendaraan/tambah', $test_data);
        $response->assertStatus(201)
                ->assertJsonStructure([
                    '_id'
                ]);
        return $response->json('_id');
    }

    protected function test_terjual(string $jenis, array $test_data)
    {
        // get token
        $token = $this->getToken();
        $this->createKendaraan($token, $test_data);

        // get data from all kendaraan sold
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
                        ->getJson('/api/kendaraan/terjual');
        $response->assertStatus(200)
                ->assertJsonFragment($test_data);
        // get data from all selected jenis sold
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
                        ->getJson("/api/penjualan/$jenis");
        $response->assertStatus(200)
                ->assertJsonFragment($test_data);
    }

    public function test_mobil_terjual_data()
    {
        $this->test_terjual('mobil', $this->test_data[0]);
    }

    public function test_motor_terjual_data()
    {
        $this->test_terjual('motor', $this->test_data[2]);
    }
    
    public function test_kendaraan_tersedia_data()
    {
        // get token
        $token = $this->getToken();
        $this->createKendaraan($token, $this->test_data[1]);
        
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
                        ->getJson('/api/kendaraan/tersedia');
        $response->assertStatus(200)
                ->assertJsonFragment($this->test_data[1]);
    }
    
    public function test_jual_kendaraan_data()
    {
        // get token
        $token = $this->getToken();
        $id = $this->createKendaraan($token, $this->test_data[1]);
        
        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])
                        ->postJson('/api/kendaraan/jual', ['id'=>$id]);
        $response->assertStatus(201)
                ->assertJsonFragment($this->test_data[3]);
    }
    
}
