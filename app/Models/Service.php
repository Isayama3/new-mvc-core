<?php

namespace App\Models;

use App\Base\Models\Base;

class Service extends Base
{
    protected static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->brands()->attach(request()->brands);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'client_favorite_services');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'service_brands')->withTimestamps();;
    }

    public function isFavorite()
    {
        if (auth()->guard('client-api')->check() == false)
            return false;

        $client = auth()->guard('client-api')->user();
        $favorite_services = $client->favoriteServices->pluck('id')->toArray();
        if (in_array($this->id, $favorite_services))
            return true;

        return false;
    }
}
