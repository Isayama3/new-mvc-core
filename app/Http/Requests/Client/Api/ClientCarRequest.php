<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\ClientBaseRequest;

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
                        'client_id' => 'nullable|exists:clients,id',
                        'brand_id' => 'nullable|exists:brands,id',
                        'media' => 'nullable|array',
                        'media.*' => 'mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
                    ];
                }
        }
    }
}
