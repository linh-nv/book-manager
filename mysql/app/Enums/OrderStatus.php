<?php
namespace App\Enums;

enum OrderStatus: int
{
    case UNPAY = 0;
    case PAYMENT_SUCCESS = 1;
    case PAYMENT_FAILED = 2;
    case PROCESSING = 3;
    case COMPLETED = 4;
    case CANCEL = 5;
    case PAYMENT_TIMEOUT = 6;

    public function label(): string
    {
        return match ($this) {
        OrderStatus::UNPAY => 'UNPAY',
        OrderStatus::PAYMENT_SUCCESS => 'PAYMENT_SUCCESS',
        OrderStatus::PAYMENT_FAILED => 'PAYMENT_FAILED',
        OrderStatus::PROCESSING => 'PROCESSING',
        OrderStatus::COMPLETED => 'COMPLETED',
        OrderStatus::CANCEL => 'CANCEL',
        OrderStatus::PAYMENT_TIMEOUT => 'PAYMENT_TIMEOUT',

        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
