<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class BookingResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'recipient_name' => $this->recipient_name,
            'car_info' => $this->car_info,
            'postal_zip' => $this->postal_zip,
            'phone_number' => $this->phone_number,
            'notes' => $this->notes,
            'status' => __('client.' . $this->status),
            'pickup_date' => $this->pickup_date,
            'pickup_time' => $this->pickup_time,
            'min_price' => $this->min_price,
            'max_price' => $this->max_price,
            'total_price' => $this->total_price,
            'service_quantity' => $this->service_quantity,
            'status_history' => StatusHistoryResource::collection(collect(json_decode($this->status_history, true))),
            'service' => ServiceResource::make($this->whenLoaded('service')),
        ];
    }
}
