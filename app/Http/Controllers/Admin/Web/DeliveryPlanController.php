<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Controllers\Web\Controller;
use App\Models\DeliveryPlan as Model;
use App\Http\Requests\Admin\Web\DeliveryPlanRequest as FormRequest;

class DeliveryPlanController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.delivery-plans.',
            hasDelete: true
        );
    }
}
