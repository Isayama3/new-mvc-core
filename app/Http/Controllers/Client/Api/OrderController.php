<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\Order as Model;
use App\Http\Requests\Client\Api\OrderRequest as FormRequest;
use App\Http\Resources\Client\OrderResource as Resource;

class OrderController extends Controller
{
    public function __construct(FormRequest $request, Model $model, $resource = Resource::class)
    {
        parent::__construct(
            $request,
            $model,
            $resource,
            hasDelete:true
        );
    }

    public function relations(): array
    {
        return [
            'products',
            'clientAddress',
            'deliveryPlan',
            'products'
        ];
    }
}
