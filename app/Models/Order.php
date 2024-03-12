<?php

namespace App\Models;

use Carbon\Carbon;
use App\Base\Models\Base;
use App\Enums\OrderStatus;
use App\Base\Notification\FCMService;
use App\Base\Notification\NotificationService;
use App\Services\OrderService;

class Order extends Base
{
    protected static function boot()
    {
        parent::boot();

        static::created(function ($order) {
            (new OrderService())->processCreatedOrder($order);
        });

        static::updated(function ($order) {
            (new OrderService())->processUpdatedOrderStatus($order);
        });
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function clientAddress()
    {
        return $this->belongsTo(ClientAddress::class);
    }

    public function deliveryPlan()
    {
        return $this->belongsTo(DeliveryPlan::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')->withTimestamps()->withPivot(['total_price', 'quantity', 'client_id', 'product_id']);
    }
}
