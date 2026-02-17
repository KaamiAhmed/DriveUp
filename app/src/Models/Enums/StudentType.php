<?php

namespace App\Models\Enums;

enum StudentType: string
{
    case TRIAL = 'Trial Student';
    case REGULAR = 'Regular Student';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

?>