<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Controllers\Web\Controller;
use App\Models\Brand as Model;
use App\Http\Requests\Admin\Web\BrandRequest as FormRequest;

class BrandController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.brands.',
            hasDelete: true
        );
    }
}
