<?php

namespace App\Models;

use App\Base\Models\Base;

class Product extends Base
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_favorite_products');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')->withTimestamps();;
    }

    public function isFavorite()
    {
        if (auth()->guard('client-api')->check() == false)
            return false;

        $client = auth()->guard('client-api')->user();
        $favorite_products = $client->favoriteProducts->pluck('id')->toArray();
        if (in_array($this->id, $favorite_products))
            return true;

        return false;
    }
}
