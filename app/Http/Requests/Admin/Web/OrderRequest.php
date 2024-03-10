<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class OrderRequest extends AdminBaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [];
                }
            case 'PUT': {
                    return [
                        'delivery_plan_id' => 'nullable|numeric|exists:delivery_plans,id',
                        'client_id' => 'nullable|numeric|exists:clients,id',
                        'status' => 'nullable|string',
                    ];
                }
        }
    }
}
