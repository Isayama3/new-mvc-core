<?php

namespace Core\Admin\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class CustomPermissionResource extends Resource
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
            'status' => $this->status,
            'name' => $this->name,
            'group' => $this->group,
        ];
    }
}
