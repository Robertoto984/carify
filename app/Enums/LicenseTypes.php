<?php

namespace App\Enums;

enum LicenseTypes: string
{
    const A = 'أ';
    const B = 'ب';
    const H = 'ه';
    const O = 'و';
    const G = 'ج';
    const D1 = 'د1';
    const D2 = 'د2';
    const NONE = null;

    public static function values()
    {
        return [
            self::A,
            self::B,
            self::H,
            self::O,
            self::G,
            self::D1,
            self::D2,
            self::NONE,
        ];
    }
}
