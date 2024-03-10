<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\Product as Model;
use App\Http\Requests\Client\Api\ProductRequest as FormRequest;
use App\Http\Resources\Client\ProductResource as Resource;

class ProductController extends Controller
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
            'category',
        ];
    }
}
