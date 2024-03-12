<?php

namespace App\Http\Requests\Client\Api;

use App\Models\Product;
use App\Base\Request\Api\ClientBaseRequest;
use App\Base\Traits\Response\SendResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class CartRequest extends ClientBaseRequest
{
    use SendResponse;

    public function prepareForValidation()
    {
        if (app()->runningInConsole()) {
            return true;
        }

        if ($this->method() == 'POST' || $this->method() == 'PUT') {
            $product = Product::find($this->product_id);
            if (!$product) {
                throw new HttpResponseException($this->ErrorMessage(__('client.product_not_found')));
            }
            $client_id = auth()->guard('client-api')->id();
            $this->merge([
                'total_price' => $product->price * $this->quantity,
                'client_id' => $client_id
            ]);
        }
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
                        'product_id' => 'required|numeric|exists:products,id,status,1',
                        'quantity' => 'required|numeric|min:1',
                        'total_price' => 'required|numeric',
                        'client_id' => 'required|numeric|exists:clients,id',
                    ];
                }
            case 'PUT': {
                    return [
                        'product_id' => 'required|numeric|exists:products,id',
                        'quantity' => 'required|numeric|min:1',
                        'total_price' => 'nullable|numeric',
                        'client_id' => 'nullable|numeric|exists:clients,id',
                    ];
                }
        }
    }
}
