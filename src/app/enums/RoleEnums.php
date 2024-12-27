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
            static::User => 'user',
            static::ADMIN => 'admin',
            static::SUPER_ADMIN => 'super_admin',
        };
    }
}