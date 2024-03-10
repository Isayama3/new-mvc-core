<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\ClientBaseRequest;

class ChangePasswordRequest extends ClientBaseRequest
{
    public function rules()
    {
        return [
            'old_password' => 'required|string|min:10|max:100',
            'password' => 'required|confirmed|string|min:8|max:100',
        ];
    }
}
