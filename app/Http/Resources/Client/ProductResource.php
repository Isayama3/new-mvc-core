<?php

namespace App\Http\Resources\Client;

use App\Base\Resources\MediaResource;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class ProductResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->getLocaleAttribute('name'),
            'description' => $this->getLocaleAttribute('description'),
            'price' => $this->price,
            'is_favorite' => $this->isFavorite(),
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'brands' => BrandResource::collection($this->whenLoaded('brands')),
            'media' => MediaResource::collection($this->getMedia()),
        ];
    }
}
