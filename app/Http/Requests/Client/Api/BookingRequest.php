<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\ClientBaseRequest;
use App\Base\Traits\Response\SendResponse;
use App\Models\Service;

class BookingRequest extends ClientBaseRequest
{
    use SendResponse;

    public function prepareForValidation()
    {
        if (app()->runningInConsole()) {
            return true;
        }

        $client = auth()->guard('client-api')->user();

        if ($this->method() == 'POST') {
            $service = Service::findOrFail($this->service_id);
            $this->merge([
                'min_price' => $service->min_price,
                'max_price' => $service->max_price,
            ]);
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
                        'recipient_name' => 'required|string',
                        'car_info' => 'required|string',
                        'postal_zip' => 'required|numeric',
                        'phone_number' => 'required|numeric',
                        'notes' => 'nullable|string',
                        'pickup_date' => 'required|string',
                        'pickup_time' => 'required|string',
                        'service_quantity' => 'required|numeric',
                        'min_price' => 'required|numeric',
                        'max_price' => 'required|numeric',
                        'service_id' => 'required|numeric|exists:services,id,status,1',
                        'client_id' => 'required|numeric|exists:clients,id',
                    ];
                }
            case 'PUT': {
                    return [
                        'recipient_name' => 'nullable|string',
                        'car_info' => 'nullable|string',
                        'postal_zip' => 'nullable|numeric',
                        'phone_number' => 'nullable|numeric',
                        'notes' => 'nullable|string',
                        'pickup_date' => 'nullable|string',
                        'pickup_time' => 'nullable|string',
                        'service_quantity' => 'nullable|numeric',
                        'total_price' => 'nullable|numeric',
                        'service_id' => 'nullable|numeric|exists:services,id',
                        'client_id' => 'nullable|numeric|exists:clients,id',
                    ];
                }
        }
    }
}
