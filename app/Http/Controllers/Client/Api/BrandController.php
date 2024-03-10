<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\Brand as Model;
use App\Http\Requests\Client\Api\BrandRequest as FormRequest;
use App\Http\Resources\Client\BrandResource as Resource;

class BrandController extends Controller
{
    public function __construct(FormRequest $request, Model $model, $resource = Resource::class)
    {
        parent::__construct(
            $request,
            $model,
            $resource
        );
    }
}
