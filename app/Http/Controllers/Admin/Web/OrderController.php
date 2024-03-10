<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Controllers\Web\Controller;
use App\Models\Order as Model;
use App\Http\Requests\Admin\Web\OrderRequest as FormRequest;

class OrderController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.orders.',
            hasCreate: false,
        );
    }
}
