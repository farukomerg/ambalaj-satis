<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS_LABELS = [
        'pending_approval' => 'Siparis alindi',
        'approved' => 'Hazirlaniyor',
        'cancelled' => 'Iptal edildi',
    ];

    public const FULFILLMENT_STEPS = [
        'waiting' => 'Sirada',
        'sourcing' => 'Hazirlaniyor',
        'packing' => 'Paketleniyor',
        'shipped' => 'Kargoya verildi',
        'on_the_way' => 'Yolda',
        'delivered' => 'Teslim edildi',
    ];

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'fulfillment_status',
        'subtotal',
        'wallet_used',
        'paid_amount',
        'total_amount',
        'shipping_address',
        'approved_at',
        'cancelled_at',
        'delivered_at',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'wallet_used' => 'decimal:2',
            'paid_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'shipping_address' => 'array',
            'approved_at' => 'datetime',
            'cancelled_at' => 'datetime',
            'delivered_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function histories()
    {
        return $this->hasMany(OrderStatusHistory::class)->latest();
    }

    public function canBeCancelledByUser(): bool
    {
        return $this->status === 'pending_approval';
    }

    public function canBeMarkedDeliveredByUser(): bool
    {
        return $this->status === 'approved' && $this->fulfillment_status === 'delivered' && ! $this->delivered_at;
    }

    public function statusLabel(): string
    {
        return self::STATUS_LABELS[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
    }

    public function fulfillmentLabel(): string
    {
        return self::FULFILLMENT_STEPS[$this->fulfillment_status] ?? ucfirst(str_replace('_', ' ', $this->fulfillment_status));
    }
}
