<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class OrderProductResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'quantity' => $this->pivot->quantity,
            'total_price' => $this->pivot->total_price,
            'product' => ProductResource::make($this),

        ];
    }
}
