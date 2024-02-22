<?php

namespace Core\Admin\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class RoleResource extends Resource
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
            'name' => $this->name,
            'description' => $this->description,
            'permissions' => $this->customPermissions(),
            'created_at'    => $this->created_at?->format('Y-m-d H:00'),
            'updated_at'    => $this->updated_at?->format('Y-m-d H:00'),
        ];
    }
}
