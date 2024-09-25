<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Kendaraan;
use App\Models\Mobil;
use App\Models\Motor;
use App\Enums\KendaraanJenis;
use App\Enums\KendaraanStatus;
use Illuminate\Support\Collection;

class KendaraanRepository implements KendaraanRepositoryInterface
{

    protected $mobil;
    protected $motor;
    protected $kendaraan;

    public function __construct(Mobil $mobil, Motor $motor, Kendaraan $kendaraan)
    {
        $this->mobil = $mobil;
        $this->motor = $motor;
        $this->kendaraan = $kendaraan;
    }

    public function all(): Collection
    {
        return $this->kendaraan->all();
    }

    public function getByStatus(KendaraanStatus $status): Collection
    {
        return $this->kendaraan->where('status', $status)->get();
    }

    public function getByStatusAndJenis(KendaraanStatus $status, KendaraanJenis $jenis): Collection
    {
        return $this->kendaraan->where('status', $status)->where('jenis', $jenis)->get();
    }

    public function createMobil(array $data): Kendaraan
    {
        return $this->mobil->create($data);
    }

    public function createMotor(array $data): Kendaraan
    {
        return $this->motor->create($data);
    }

    public function deleteAll(): void
    {
        $this->kendaraan->truncate();
    }

    public function getValidatorByJenis(string $jenis): array
    {
        $validators = [
            KendaraanJenis::MOBIL->value => $this->mobil->getValidator(),
            KendaraanJenis::MOTOR->value => $this->motor->getValidator(),
        ];
        return array_merge($this->kendaraan->getValidator(), array_key_exists($jenis, $validators) ? $validators[$jenis] : []);
    }
}
