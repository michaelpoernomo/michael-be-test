<?php

namespace App\Traits;

trait HasValidator
{
    public static function allValuesValidator(): string
    {
        return implode(',', array_map(fn($case) => $case->value, Self::cases()));
    }
}
