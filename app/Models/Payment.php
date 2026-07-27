<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = ['order_id', 'transaction_id', 'gateway', 'amount', 'status', 'ref_number'];
    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'status' => 'integer',
        ];
    }

    const CANCELD = -2;
    const UNSUCCESSFUL = -1;
    const PAYING = 0;
    const SUCCESSUL = 1;

    const STATUS_TEXTS = [
        self::CANCELD => 'لغو شده',
        self::UNSUCCESSFUL => 'ناموفق',
        self::PAYING => 'درحال پرداخت',
        self::SUCCESSUL => 'موفق',
    ];


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function scopeFilter($query, array $request)
    {
        $query->when(
            $request['order_id'] ?? false,
            fn($query, $request) => $query->where('order_id', $request)
        );

        $query->when(
            $request['status'] ?? false,
            fn($query, $request) => $query->where('status', $request)
        );
    }
}
