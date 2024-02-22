<?php

namespace Core\Admin\Admin\Resources;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Resources\Json\JsonResource as Resource;

class GroupResource extends Resource
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
            'name' => $this->group,
            'permissions' => PermissionResource::collection(Permission::where('group', $this->group)->get()),
        ];
    }
}
