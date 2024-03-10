<?php

namespace App\Http\Requests\Client\Api\Auth;

use App\Base\Request\Api\BaseRequest;

class ForgetPasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'password' => 'required|confirmed|string|min:8|max:100',
            'email' => 'required|string|email|exists:clients,email',
        ];
    }
}
