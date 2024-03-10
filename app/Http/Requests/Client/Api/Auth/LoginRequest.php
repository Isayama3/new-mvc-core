<?php

namespace App\Http\Requests\Client\Api\Auth;

use App\Base\Request\Api\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email' => 'required|string|email|exists:clients,email',
            'password' => ["required"],
            'device_token' => 'nullable',
            'os_type' => 'nullable',
        ];
    }
}
