<?php

namespace App\Models;

use App\Base\Models\Base;

class ClientCar extends Base
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
