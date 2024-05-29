<?php
namespace App\Enum;

enum LendTicketStatus: int
{
    case PENDING = 1;
    case APPROVED = 2;
    case REJECTED = 3;

    public function label(): string
    {
        return match ($this) {
        LendTicketStatus::PENDING => 'Pending',
        LendTicketStatus::APPROVED => 'Approved',
        LendTicketStatus::REJECTED => 'Rejected',

        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
