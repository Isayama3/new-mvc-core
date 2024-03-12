<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Controllers\Web\Controller;
use App\Models\Service as Model;
use App\Http\Requests\Admin\Web\ServiceRequest as FormRequest;

class ServiceController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.services.',
            hasDelete: true
        );
    }

    public function relations(): array
    {
        return [
            'category',
            'brands'
        ];
    }
}
