<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\ClientBaseRequest;
use App\Models\ClientAddress;

class ClientAddressRequest extends ClientBaseRequest
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
                        'client_id' => 'required|exists:clients,id',
                        'default' => 'nullable|numeric|min:0|max:1',
                    ];
                }
            case 'PUT': {
                    return [
                        'client_name' => 'nullable|string',
                        'phone' => 'nullable|numeric|max:1000000000000000',
                        'address' => 'nullable|string',
                        'default' => 'nullable|numeric|min:0|max:1',
                    ];
                }
        }
    }

    public function withValidator($validator)
    {
        if (app()->runningInConsole()) {
            return true;
        }

        $validator->after(function ($validator) {
            if ($this->method == 'PUT') {
                if ($this->default == 1) {
                    auth()->guard('client-api')->user()->addresses()->update(['default' => 0]);
                    ClientAddress::findOrFail($this->client_address)->update(['default' => 1]);
                }
            }
        });
    }
}
