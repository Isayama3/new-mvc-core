<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\DeliveryPlan as Model;
use App\Http\Requests\Client\Api\DeliveryPlanRequest as FormRequest;
use App\Http\Resources\Client\DeliveryPlanResource as Resource;

class DeliveryPlanController extends Controller
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
