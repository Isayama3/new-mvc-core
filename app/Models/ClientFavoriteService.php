<?php

namespace App\Models;

use App\Base\Models\Base;

class ClientFavoriteService extends Base
{
    public function services()
    {
        return $this->belongsTo(Service::class);
    }
}
