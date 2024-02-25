<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\Web\Controller;
use App\Models\Admin\Role as Model;
use App\Http\Requests\Admin\Web\RoleRequest as FormRequest;
use Illuminate\Support\Facades\Request;

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

    public function store()
    {
        $record = $this->model->create($this->request->validated());
        $record->permissions()->attach(request()->permissions);
        $index_route = str_replace('create', 'index', Request::route()->getName());
        return redirect()->route($index_route)->with('success', 'Record added successfully!');
    }

    public function update($id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($this->request->validated());
        $record->permissions()->sync($this->request->permissions);
        $index_route = str_replace('update', 'index', Request::route()->getName());
        return redirect()->route($index_route)->with('success', 'Record updated successfully!');
    }
}
