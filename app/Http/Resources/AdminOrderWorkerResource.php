<?php

namespace Core\Admin\Admin\Resources;

use App\Base\Resources\SimpleResource;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class AdminOrderWorkerResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_status' => __('order.admin.' . $this->order_status),
            'admin' => SimpleResource::make($this->admin),
            'created_at'    => $this->created_at?->format('Y-m-d H:00'),
            'updated_at'    => $this->updated_at?->format('Y-m-d H:00'),
        ];
    }
}
