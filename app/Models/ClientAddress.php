<?php

namespace App\Models;

use App\Base\Models\Base;

class ClientAddress extends Base
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
