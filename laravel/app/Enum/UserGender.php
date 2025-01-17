<?php
namespace App\Enum;

enum UserGender: int
{
    case MALE = 0;
    case FEMALE = 1;


    public function label(): string
    {
        return match ($this) {
        UserGender::MALE => 'Male',
        UserGender::FEMALE => 'Female',

        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
