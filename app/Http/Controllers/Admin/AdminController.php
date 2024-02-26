<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\Web\Controller;
use App\Models\Admin\Admin as Model;
use App\Http\Requests\Admin\Web\AdminRequest as FormRequest;

class AdminController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.admins.',
        );
    }
}
