<?php
namespace App\Enums;

enum PaymentStatus: int
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
        PaymentStatus::UNPAY => 'UNPAY',
        PaymentStatus::PAYMENT_SUCCESS => 'PAYMENT_SUCCESS',
        PaymentStatus::PAYMENT_FAILED => 'PAYMENT_FAILED',
        PaymentStatus::PROCESSING => 'PROCESSING',
        PaymentStatus::COMPLETED => 'COMPLETED',
        PaymentStatus::CANCEL => 'CANCEL',
        PaymentStatus::PAYMENT_TIMEOUT => 'PAYMENT_TIMEOUT',

        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }
}
