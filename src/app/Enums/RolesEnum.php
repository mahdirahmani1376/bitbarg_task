<?php

namespace App\Enums;

enum RolesEnum: string
{
    case ADMIN = 'admin';
    case User = 'user';
    case SUPER_ADMIN = 'super_admin';

    public function label(): string
    {
        return match ($this) {
            self::User => 'user',
            self::ADMIN => 'admin',
            self::SUPER_ADMIN => 'super_admin',
        };
    }
}
