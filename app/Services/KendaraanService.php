<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Kendaraan;
use App\Enums\KendaraanJenis;
use App\Enums\KendaraanStatus;
use App\Repositories\KendaraanRepositoryInterface;
use Illuminate\Support\Collection;

class KendaraanService
{
    protected $kendaraanRepository;

    public function __construct(KendaraanRepositoryInterface $kendaraanRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;
    }

    public function getAll(): Collection
    {
        return $this->kendaraanRepository->all();
    }

    public function getAllSold(): Collection
    {
        return $this->kendaraanRepository->getByStatus(KendaraanStatus::TERJUAL);
    }

    public function getAllInStock(): Collection
    {
        return $this->kendaraanRepository->getByStatus(KendaraanStatus::TERSEDIA);
    }

    public function getSoldByJenis(string $jenis): Collection
    {
        return $this->kendaraanRepository->getByStatusAndJenis(KendaraanStatus::TERJUAL, KendaraanJenis::getTypes($jenis));
    }

    public function create(string $jenis, array $data): Kendaraan|string
    {
        $validator = \Validator::make($data, $this->kendaraanRepository->getValidatorByJenis($jenis));
        if ($validator->fails()) {
            throw new \Exception($validator->errors()->toJson());
        }
        return $this->kendaraanRepository->create($data);
    }

    public function deleteAll(): void
    {
        $this->kendaraanRepository->deleteAll();
    }
}
