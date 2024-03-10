<?php

namespace App\Models;

use Carbon\Carbon;
use App\Base\Models\Base;
use App\Enums\OrderStatus;

class Order extends Base
{
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $client = auth()->guard('client-api')->user();
            $total_price = 0;
            foreach ($client->cart as $item) {
                $model->products()->attach($item->product_id, [
                    'client_id' => $item->client_id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'total_price' => $item->total_price
                ]);

                $total_price += $item->total_price * $item->quantity;
            }

            $status_history = [
                ['status' => OrderStatus::ORDERPLACED->value, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
            ];

            $model->update([
                'total_price' => $total_price,
                'status_history' => json_encode($status_history),
            ]);

            $client->cart()->delete();
        });

        static::updated(function ($model) {
            if ($model->isDirty('status')) {
                $history = [];
                $status_history = json_decode($model->status_history, true);
                foreach ((array)$status_history as $hsi) {
                    $history[] = $hsi;
                }
                $history[] = ['status' => $model->status, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')];
                if (!empty($history)) {
                    $model->syncOriginal();
                    $model->update([
                        'status_history' => json_encode($history),
                    ]);
                }
            }
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
