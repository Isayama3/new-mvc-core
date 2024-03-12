<?php

namespace App\Models;

use Carbon\Carbon;
use App\Base\Models\Base;
use App\Enums\BookingStatus;
use App\Services\BookingService;
use App\Base\Services\FCMService;

class Booking extends Base
{
    protected static function boot()
    {
        parent::boot();

        static::created(function ($booking) {
            (new BookingService())->processCreatedBooking($booking);
        });

        static::updated(function ($booking) {
            (new BookingService())->processUpdatedBookingStatus($booking);
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
