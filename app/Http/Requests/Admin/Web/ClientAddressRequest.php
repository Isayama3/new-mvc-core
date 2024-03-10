<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class ClientAddressRequest extends AdminBaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'client_name' => 'required|string',
                        'address' => 'required|string',
                        'phone' => 'required|numeric',
                        'client_id' => 'required|exists:clients,id',
                    ];
                }
            case 'PUT': {
                    return [
                        'client_name' => 'nullable|string',
                        'address' => 'nullable|string',
                        'phone' => 'nullable|numeric',
                        'client_id' => 'nullable|exists:clients,id',
                    ];
                }
        }
    }
}
