<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\ClientBaseRequest;
use App\Base\Request\Web\AdminBaseRequest;

class ProfileRequest extends ClientBaseRequest
{
    public function rules()
    {
        // dd($this->all());
        return [
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|email|string|max:100',
            'phone' => 'nullable|numeric',
            'old_password' => 'required_if:new_password,!null|string|max:100',
            'new_password' => 'nullable|string|confirmed|max:100',
        ];
    }
}
