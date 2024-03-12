<?php

namespace App\Http\Resources\Client;

use App\Base\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class ClientCarResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'plate_number' => $this->plate_number,
            'model' => $this->model,
            'plate_source' => $this->plate_source,
            'year' => $this->year,
            'plate_code' => $this->plate_code,
            'default' => $this->default,
            'color' => $this->color,
            'client_name' => $this->client_name,
            'client_phone' => $this->client_phone,
            'brand' => BrandResource::make($this->whenLoaded('brand')),
            'client' => ClientResource::make($this->whenLoaded('client')),
            'media' => MediaResource::collection($this->getMedia()),

        ];
    }
}
