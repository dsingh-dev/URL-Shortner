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

    /**
     * Get all available roles for web guard.
     */
    public static function getWebRoles(): array
    {
        return [
            self::ADMIN->value,
            self::MEMBER->value,
        ];
    }

    /**
     * Get all available roles for superadmin guard.
     */
    public static function getSuperadminRoles(): array
    {
        return [
            self::SUPERADMIN->value,
        ];
    }

    /**
     * Check if role is for web guard.
     */
    public function isWebRole(): bool
    {
        return in_array($this->value, self::getWebRoles());
    }

    /**
     * Check if role is for superadmin guard.
     */
    public function isSuperadminRole(): bool
    {
        return in_array($this->value, self::getSuperadminRoles());
    }
}
