<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class ClientAddressResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_name' => $this->client_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'client' => ClientResource::make($this->whenLoaded('client'))
        ];
    }
}
