<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class CategoryResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getLocaleAttribute('name'),
            'description' => $this->getLocaleAttribute('description'),
            'image' => $this->image_url,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'services' => ServiceResource::collection($this->whenLoaded('services')),
        ];
    }
}
