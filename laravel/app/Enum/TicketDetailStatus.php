<?php
namespace App\Enum;

enum TicketDetailStatus: int
{
    case BORROWED = 0;
    case RETURNED = 1;
    case LOST = 2;
    case REJECTED = 3;

    public function label(): string
    {
        return match ($this) {
        TicketDetailStatus::BORROWED => 'borrowed',
        TicketDetailStatus::RETURNED => 'returned',
        TicketDetailStatus::LOST => 'lost',
        TicketDetailStatus::REJECTED => 'overdue',

        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
