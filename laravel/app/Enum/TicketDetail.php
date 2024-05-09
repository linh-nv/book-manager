<?php
namespace App\Enum;

enum TicketDetail: string
{
    case BORROWED = 0;
    case RETURNED = 1;
    case LOST = 2;
    case REJECTED = 3;

    public function label(): string
    {
        return match ($this) {
        TicketDetail::BORROWED => 'borrowed',
        TicketDetail::RETURNED => 'returned',
        TicketDetail::LOST => 'lost',
        TicketDetail::REJECTED => 'overdue',

        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
