<?php

namespace App\Enums;

use App\Traits\HasValidator;

enum KendaraanStatus: string
{
    use HasValidator;

    case TERJUAL = 'sold';
    case TERSEDIA = 'inStock';
}