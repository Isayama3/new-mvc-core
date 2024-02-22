<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\Web\Controller;
use App\Models\Admin\Role as Model;
use App\Http\Requests\Admin\Web\RoleRequest as FormRequest;

class RoleController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.roles.',
        );
    }

    public function indexActions(): array
    {
        return [
            'create' => $this->can('roles.store'),
            'detail' => $this->can('roles.show'),
            'remove' => ($this->hasDelete && $this->can('roles.destroy')),
            'update' => $this->can('roles.update'),
        ];
    }
}
