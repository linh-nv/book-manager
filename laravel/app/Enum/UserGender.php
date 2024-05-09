<?php
namespace App\Enum;

enum LendTicketStatus: int
{
    case MALE = 0;
    case FEMALE = 1;


    public function label(): string
    {
        return match ($this) {
        LendTicketStatus::MALE => 'Male',
        LendTicketStatus::FEMALE => 'Female',

        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
