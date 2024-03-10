<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class OrderResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'status' => __('client.' . $this->status),
            'status_history' => StatusHistoryResource::collection(collect(json_decode($this->status_history, true))),
            'delivery_plan' => DeliveryPlanResource::make($this->whenLoaded('deliveryPlan')),
            'client_address' => ClientAddressResource::make($this->whenLoaded('clientAddress')),
            'products' => OrderProductResource::collection($this->whenLoaded('products')),

        ];
    }
}
