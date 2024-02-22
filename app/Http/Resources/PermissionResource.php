<?php

namespace Core\Admin\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource as Resource;

class PermissionResource extends Resource
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
            'routes' => $this->routes,
        ];
    }
}
