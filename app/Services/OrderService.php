<?php

namespace App\Services;

use App\Models\Order;
use App\Enums\OrderStatus;
use App\Base\Notification\FCMService;
use App\Base\Notification\NotificationService;
use Carbon\Carbon;

class OrderService
{
    public function processCreatedOrder(Order $order)
    {
        $client = auth()->guard('client-api')->user();
        $totalPrice = 0;

        foreach ($client->cart as $item) {
            $this->attachProductToOrder($order, $item);
            $totalPrice += $item->total_price * $item->quantity;
        }

        $order->update([
            'total_price' => $totalPrice,
            'status_history' => $this->buildStatusHistory(OrderStatus::ORDERPLACED),
        ]);

        $client->cart()->delete();
    }

    protected function attachProductToOrder(Order $order, $item)
    {
        $order->products()->attach($item->product_id, [
            'client_id' => $item->client_id,
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'total_price' => $item->total_price
        ]);
    }

    protected function buildStatusHistory($status)
    {
        return json_encode([['status' => $status->value, 'created_at' => now()->format('Y-m-d H:i:s')]]);
    }

    public function processUpdatedOrderStatus(Order $order)
    {
        if ($order->isDirty('status')) {
            $this->updateStatusHistory($order);
            $this->sendOrderStatusNotification($order);
        }
    }

    public function updateStatusHistory(Order $order)
    {
        $history = [];
        $status_history = json_decode($order->status_history, true);
        foreach ((array)$status_history as $hsi) {
            $history[] = $hsi;
        }
        $history[] = ['status' => $order->status, 'created_at' => Carbon::now()->format('Y-m-d H:i:s')];
        if (!empty($history)) {
            $order->syncOriginal();
            $order->update([
                'status_history' => json_encode($history),
            ]);
        }
    }
    protected function sendOrderStatusNotification(Order $order)
    {
        $notificationService = new NotificationService();
        $notificationService->addChannel('fcm', new FCMService());
        $notificationService->send(
            'fcm',
            $order->client->device_token ?? '',
            $order->client,
            __('client.order_status_update', [], 'ar'),
            __('client.order_status_update', [], 'en'),
            __('client.your_order_status_has_been_updated_to', [], 'ar') . ' ' . __("client.$order->status", [], 'ar'),
            __('client.your_order_status_has_been_updated_to', [], 'en') . ' ' . __("client.$order->status", [], 'en'),
        );
    }
}
