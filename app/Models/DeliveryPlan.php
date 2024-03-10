<?php

namespace App\Models;

use App\Base\Models\Base;

class DeliveryPlan extends Base
{
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
