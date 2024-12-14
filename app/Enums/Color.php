<?php

namespace App\Enums;

enum Color: string
{
    const Red = 'أحمر';
    const Green = 'أخضر';
    const Blue = 'أزرق';
    const Yellow = 'أصفر';
    const Black = 'أسود';
    const White = 'أبيض';

    public static function values()
    {
        return [
            self::Red,
            self::Green,
            self::Blue,
            self::Yellow,
            self::Black,
            self::White,
        ];
    }
}
