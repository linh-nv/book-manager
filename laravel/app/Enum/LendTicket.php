<?php
namespace App\Enum;

enum LendTicket: string
{
    case PENDING = 0;
    case APPROVED = 1;
    case REJECTED = 2;

    public function label(): string
    {
        return match ($this) {
        LendTicket::PENDING => 'Pending',
        LendTicket::APPROVED => 'Approved',
        LendTicket::REJECTED => 'Rejected',

        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
