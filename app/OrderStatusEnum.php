<?php

namespace App;

enum OrderStatusEnum : int
{
    case CANCELD = -2;
    case UNSUCCESSFUL = -1;
    case PAYING = 0;
    case SUCCESSUL = 1;

    public function label(): string
    {
        return match ($this) {
            self::CANCELD => 'لغو شده',
            self::UNSUCCESSFUL => 'ناموفق',
            self::PAYING => 'درحال پرداخت',
            self::SUCCESSUL => 'موفق',
        };
    }
}
