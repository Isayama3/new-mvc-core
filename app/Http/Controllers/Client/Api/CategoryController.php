<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\Category as Model;
use App\Http\Requests\Client\Api\CategoryRequest as FormRequest;
use App\Http\Resources\Client\CategoryResource as Resource;

class CategoryController extends Controller
{
    public function __construct(FormRequest $request, Model $model, $resource = Resource::class)
    {
        parent::__construct(
            $request,
            $model,
            $resource
        );
    }

    public function relations(): array
    {
        return [
            'products',
            'services'
        ];
    }
}
