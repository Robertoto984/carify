<?php

namespace App\Enums;

enum FuelTypes: string
{
    const Gasoline = 'بنزين';
    const Diesel = 'مازوت';

    public static function values()
    {
        return [
            self::Gasoline,
            self::Diesel,
        ];
    }
}
