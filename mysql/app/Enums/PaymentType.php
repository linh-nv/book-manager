<?php

namespace App\Enums;

enum PaymentType: int
{
    case CASH_ON_DELIVERY = 1;
    case BANK_TRANSFER = 2;
    case INTERNATIONAL_CARD = 3;
    case DOMESTIC_CARD = 4;
    case ZALO_PAY = 5;

    public function label(): string
    {
        return match($this) {
            self::CASH_ON_DELIVERY => 'Thanh toán khi nhận hàng',
            self::BANK_TRANSFER => 'Chuyển khoản',
            self::INTERNATIONAL_CARD => 'Thẻ quốc tế',
            self::DOMESTIC_CARD => 'Thẻ nội địa',
            self::ZALO_PAY => 'Zalo pay',
        };
    }
}
