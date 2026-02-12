<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case MEMBER = 'member';
    case SUPERADMIN = 'superadmin';

    /**
     * Get the display name for the role.
     */
    public function getDisplayName(): string
    {
        return match($this) {
            self::ADMIN => 'Admin',
            self::MEMBER => 'Member',
            self::SUPERADMIN => 'Super Admin',
        };
    }
}
