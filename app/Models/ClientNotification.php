<?php

namespace App\Models;

use App\Base\Models\Base;

class ClientNotification extends Base
{
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
