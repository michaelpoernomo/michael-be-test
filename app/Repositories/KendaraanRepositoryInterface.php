<?php

namespace App\Repositories;

use App\Enums\KendaraanJenis;
use App\Enums\KendaraanStatus;

interface KendaraanRepositoryInterface
{
    public function all();
    public function getByStatus(KendaraanStatus $status);
    public function getByStatusAndJenis(KendaraanStatus $status, KendaraanJenis $jenis);
    public function createMobil(array $data);
    public function createMotor(array $data);
    public function deleteAll();
}