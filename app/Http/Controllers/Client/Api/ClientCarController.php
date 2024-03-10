<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\ClientCar as Model;
use App\Http\Requests\Client\Api\ClientCarRequest as FormRequest;
use App\Http\Resources\Client\ClientCarResource as Resource;

class ClientCarController extends Controller
{
    public function __construct(FormRequest $request, Model $model, $resource = Resource::class)
    {
        parent::__construct(
            $request,
            $model,
            $resource,
            hasDelete: true
        );
    }

    public function relations(): array
    {
        return [
            'client',
            'brand'
        ];
    }
}
