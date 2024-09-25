<?php

namespace App\Enums;

use App\Traits\HasValidator;

enum KendaraanJenis: string
{
    use HasValidator;

    case MOBIL = 'mobil';
    case MOTOR = 'motor';


    public static function getTypes(string $jenis): self
    {
        return match ($jenis) {
            'mobil' => self::MOBIL,
            'motor' => self::MOTOR,
        };
    }
}