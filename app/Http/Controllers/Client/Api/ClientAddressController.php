<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\ClientAddress as Model;
use App\Http\Requests\Client\Api\ClientAddressRequest as FormRequest;
use App\Http\Resources\Client\ClientAddressResource as Resource;

class ClientAddressController extends Controller
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
        ];
    }

    public function customWhen(): array
    {
        return [
            'condition' => true,
            'callback' => function ($q) {
                $q->where('client_id', auth()->guard('client-api')->id());
            },
        ];
    }
}
