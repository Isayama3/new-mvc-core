<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class StatusHistoryResource extends Resource
{
    public function toArray($request)
    {
        return [
            'status' => __('client.' . $this['status']),
            'created_at'    => $this['created_at'],
        ];
    }
}
