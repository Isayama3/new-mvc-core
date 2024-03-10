<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\ClientBaseRequest;
use App\Base\Traits\Response\SendResponse;
use Illuminate\Http\Exceptions\HttpResponseException;


class OrderRequest extends ClientBaseRequest
{
    use SendResponse;

    public function prepareForValidation()
    {
        if (app()->runningInConsole()) {
            return true;
        }
        
        $client = auth()->guard('client-api')->user();

        if ($this->method() == 'POST' && $client->cart->isEmpty()) {
            throw new HttpResponseException($this->ErrorMessage(__('client.cart_is_empty')));
        }

        $this->merge([
            'client_id' => $client->id,
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
                        'client_address_id' => 'required|numeric|exists:client_addresses,id',
                        'delivery_plan_id' => 'required|numeric|exists:delivery_plans,id',
                        'client_id' => 'required|numeric|exists:clients,id',
                    ];
                }
            case 'PUT': {
                    return [];
                }
        }
    }
}
