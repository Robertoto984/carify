<?php

namespace App\Enums;

enum MaintenanceTypes
{
    const Iternal = 'داخلي';
    const External = 'خارجي';

    public static function values()
    {
        return [
            self::Iternal,
            self::External,
        ];
    }
}
