<?php

namespace App\Http\Resources\Client;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class ClientNotificationResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->getLocaleAttribute('title'),
            'body' => $this->getLocaleAttribute('body'),
            'created_at'    => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
