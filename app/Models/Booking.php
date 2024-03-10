<?php

namespace App\Models;

use App\Base\Models\Base;
use App\Enums\BookingStatus;
use Carbon\Carbon;

class Booking extends Base
{
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $status_history = [
                ['status' => BookingStatus::BOOKINGPLACED->value, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
            ];

            $model->update([
                'status_history' => json_encode($status_history),
            ]);
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

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
