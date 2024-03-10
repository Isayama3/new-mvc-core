<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\BaseRequest;

class ClientAddressRequest extends BaseRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'client_id' => auth()->guard('client-api')->id()
        ]);
    }
    
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
                        'phone' => 'required|numeric|max:1000000000000000',
                        'address' => 'required|string',
                        'client_id' => 'required|exists:clients,id'
                    ];
                }
            case 'PUT': {
                    return [
                        'client_name' => 'nullable|string',
                        'phone' => 'nullable|numeric|max:1000000000000000',
                        'address' => 'nullable|string',
                        'client_id' => 'nullable|exists:clients,id'
                    ];
                }
        }
    }
}
