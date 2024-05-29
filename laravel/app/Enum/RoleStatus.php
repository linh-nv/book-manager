<?php
namespace App\Enum;

enum RoleStatus: int
{
    case ADMIN = 1;
    case MANAGER = 2;


    public function label(): string
    {
        return match ($this) {
            RoleStatus::ADMIN => 'admin',
            RoleStatus::MANAGER => 'manager',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
