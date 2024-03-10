<?php

namespace App\Models;

use App\Base\Models\Base;

class ClientFavoriteProduct extends Base
{
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
