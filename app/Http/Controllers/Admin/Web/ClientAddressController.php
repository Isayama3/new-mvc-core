<?php

namespace App\Http\Controllers\Admin\Web;

use App\Base\Controllers\Web\Controller;
use App\Models\ClientAddress as Model;
use App\Http\Requests\Admin\Web\ClientAddressRequest as FormRequest;

class ClientAddressController extends Controller
{
    public function __construct(FormRequest $request, Model $model)
    {
        parent::__construct(
            $request,
            $model,
            view_path: 'admin.client-addresses.',
            hasDelete: true
        );
    }


    public function relations(): array
    {
        return [
            'client',
        ];
    }
}
