<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\ClientBaseRequest;

class ClientFavoriteServiceRequest extends ClientBaseRequest
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
                        'client_id' => 'required|exists:clients,id',
                        'service_id' => 'required|exists:products,id',
                    ];
                }
            case 'PUT': {
                    return [];
                }
        }
    }
}
