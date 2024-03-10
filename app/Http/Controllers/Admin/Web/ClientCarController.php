<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Controllers\Web\Controller;
use App\Models\ClientCar as Model;
use App\Http\Requests\Admin\Web\ClientCarRequest as FormRequest;

class ClientCarController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.client-cars.',
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
