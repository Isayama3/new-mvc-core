<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\ClientBaseRequest;
use App\Models\ClientCar;

class ClientCarRequest extends ClientBaseRequest
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
                        'plate_number' => 'required|numeric',
                        'model' => 'required|string',
                        'plate_source' => 'required|string',
                        'year' => 'required|numeric',
                        'plate_code' => 'required|string',
                        'color' => 'required|string',
                        'client_name' => 'required|string',
                        'client_phone' => 'required|numeric',
                        'default' => 'nullable|numeric|min:0|max:1',
                        'client_id' => 'required|exists:clients,id',
                        'brand_id' => 'required|exists:brands,id',
                        'media' => 'required|array',
                        'media.*' => 'mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
                    ];
                }
            case 'PUT': {
                    return [
                        'plate_number' => 'nullable|numeric',
                        'model' => 'nullable|string',
                        'plate_source' => 'nullable|string',
                        'year' => 'nullable|numeric',
                        'plate_code' => 'nullable|numeric',
                        'color' => 'nullable|string',
                        'client_name' => 'nullable|string',
                        'client_phone' => 'nullable|numeric',
                        'default' => 'nullable|numeric|min:0|max:1',
                        'brand_id' => 'nullable|exists:brands,id',
                        'media' => 'nullable|array',
                        'media.*' => 'mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
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
                    auth()->guard('client-api')->user()->cars()->update(['default' => 0]);
                    ClientCar::findOrFail($this->client_car)->update(['default' => 1]);
                }
            }
        });
    }
}
