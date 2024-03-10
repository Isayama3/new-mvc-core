<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class DeliveryPlanResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getLocaleAttribute('name'),
            'description' => $this->getLocaleAttribute('description'),
            'price' => $this->price,
        ];
    }
}
