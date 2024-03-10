<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\Service as Model;
use App\Http\Requests\Client\Api\ServiceRequest as FormRequest;
use App\Http\Resources\Client\ServiceResource as Resource;

class ServiceController extends Controller
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
