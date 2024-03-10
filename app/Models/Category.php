<?php

namespace App\Models;

use App\Base\Models\Base;

class Category extends Base
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
