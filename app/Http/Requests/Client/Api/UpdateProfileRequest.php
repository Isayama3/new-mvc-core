<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\ClientBaseRequest;

class UpdateProfileRequest extends ClientBaseRequest
{
    public function rules()
    {
        return [
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|unique:clients,email,' . auth()->guard('client-api')->id() . '|email|string|max:100',
            'phone' => 'nullable|unique:clients,phone,' . auth()->guard('client-api')->id() . '|numeric',
            'image' => 'nullable|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
        ];
    }
}
