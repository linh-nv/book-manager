<?php
namespace App\Enum;

enum TicketDetailStatus: int
{
    case BORROWED = 1;
    case RETURNED = 2;
    case LOST = 3;
    case REJECTED = 4;

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
