<?php

namespace App\Models;

use App\Base\Models\Base;

class Cart extends Base
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
