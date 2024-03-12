<?php

namespace App\Services;

use App\Models\Booking;
use App\Enums\BookingStatus;
use App\Base\Notification\FCMService;
use App\Base\Notification\NotificationService;
use Carbon\Carbon;

class BookingService
{
    public function processCreatedBooking(Booking $booking)
    {
        $status_history = [
            ['status' => BookingStatus::BOOKINGPLACED->value, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];

        $booking->update([
            'status_history' => json_encode($status_history),
        ]);
    }

    protected function buildStatusHistory($status)
    {
        return json_encode([['status' => $status->value, 'created_at' => now()->format('Y-m-d H:i:s')]]);
    }

    public function processUpdatedBookingStatus(Booking $booking)
    {
        if ($booking->isDirty('status')) {
            $this->updateStatusHistory($booking);
            $this->sendBookingStatusNotification($booking);
        }
    }

    public function updateStatusHistory(Booking $booking)
    {
        $history = [];
        $status_history = json_decode($booking->status_history, true);
        foreach ((array)$status_history as $hsi) {
            $history[] = $hsi;
        }
        $history[] = ['status' => $booking->status, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')];
        if (!empty($history)) {
            $booking->syncOriginal();
            $booking->update([
                'status_history' => json_encode($history),
            ]);
        }
    }

    protected function sendBookingStatusNotification(Booking $booking)
    {
        $notificationService = new NotificationService();
        $notificationService->addChannel('fcm', new FCMService());
        $notificationService->send(
            'fcm',
            $booking->client->device_token ?? '',
            $booking->client,
            __('client.booking_status_update', [], 'ar'),
            __('client.booking_status_update', [], 'en'),
            __('client.your_booking_status_has_been_updated_to', [], 'ar') . ' ' . __("client.$booking->status", [], 'ar'),
            __('client.your_booking_status_has_been_updated_to', [], 'en') . ' ' . __("client.$booking->status", [], 'en'),
        );
    }
}
