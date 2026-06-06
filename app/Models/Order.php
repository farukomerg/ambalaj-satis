<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS_LABELS = [
        'pending_approval' => 'Onay bekliyor',
        'approved' => 'Onaylandi',
        'cancelled' => 'Iptal edildi',
        'completed' => 'Teslim alindi',
    ];

    public const FULFILLMENT_STEPS = [
        'waiting' => 'Sirada',
        'sourcing' => 'Hazirlaniyor',
        'packing' => 'Paketleniyor',
        'shipped' => 'Kargoya verildi',
        'on_the_way' => 'Yolda',
        'delivered' => 'Teslim edildi',
        'cancelled' => 'Iptal edildi',
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

    public function canBeCancelledByAdmin(): bool
    {
        return in_array($this->status, ['pending_approval', 'approved'], true) && ! $this->cancelled_at;
    }

    public function canBeMarkedDeliveredByUser(): bool
    {
        return $this->status === 'approved' && $this->fulfillment_status === 'delivered' && ! $this->delivered_at;
    }

    public function canAdvanceByAdmin(): bool
    {
        return $this->status === 'approved' && $this->fulfillment_status !== 'delivered';
    }

    public function statusLabel(): string
    {
        return self::STATUS_LABELS[$this->status] ?? ucfirst(str_replace('_', ' ', $this->status));
    }

    public function customerStatusLabel(): string
    {
        return match ($this->status) {
            'approved' => $this->fulfillmentLabel(),
            'completed' => 'Teslim alindi',
            default => $this->statusLabel(),
        };
    }

    public function adminStatusLabel(): string
    {
        if ($this->status === 'approved') {
            return 'Onaylandi / '.$this->fulfillmentLabel();
        }

        return $this->statusLabel();
    }

    public function fulfillmentLabel(): string
    {
        return self::FULFILLMENT_STEPS[$this->fulfillment_status] ?? ucfirst(str_replace('_', ' ', $this->fulfillment_status));
    }

    public function statusVariant(): string
    {
        return match ($this->status) {
            'cancelled' => 'danger',
            'completed' => 'success',
            'approved' => $this->fulfillment_status === 'delivered' ? 'success' : 'info',
            default => 'warning',
        };
    }

    public function secondaryStatusText(): string
    {
        return match ($this->status) {
            'pending_approval' => 'Admin onayi bekleniyor.',
            'approved' => 'Guncel surec: '.$this->fulfillmentLabel(),
            'completed' => 'Siparis teslim alindi olarak kapatildi.',
            'cancelled' => 'Siparis iptal edilip iade bakiyeye aktarildi.',
            default => $this->fulfillmentLabel(),
        };
    }

    public function nextFulfillmentLabel(): ?string
    {
        if (! $this->canAdvanceByAdmin()) {
            return null;
        }

        $steps = self::advanceableFulfillmentSteps();
        $currentIndex = array_search($this->fulfillment_status, $steps, true);
        $next = $steps[min(($currentIndex === false ? 0 : $currentIndex + 1), count($steps) - 1)];

        return self::FULFILLMENT_STEPS[$next] ?? null;
    }

    public static function advanceableFulfillmentSteps(): array
    {
        return ['waiting', 'sourcing', 'packing', 'shipped', 'on_the_way', 'delivered'];
    }
}
