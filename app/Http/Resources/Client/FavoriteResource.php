<?php

namespace App\Http\Resources\Client;

use App\Base\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class FavoriteResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getLocaleAttribute('name'),
            'description' => $this->getLocaleAttribute('description'),
            'type' => $this->min_price ? 'service' : 'product',
            'price' => $this->price,
            'min_price' => $this->min_price,
            'max_price' => $this->max_price,
            'is_favorite' => true,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'media' => MediaResource::collection($this->getMedia()),
        ];
    }
}
