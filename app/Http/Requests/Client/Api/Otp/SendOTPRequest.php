<?php

namespace App\Http\Requests\Client\Api\Otp;

use App\Base\Request\Api\BaseRequest;
use Illuminate\Validation\Rule;

class SendOTPRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => [
                'nullable',
                'numeric',
                'exists:clients,phone',
                Rule::requiredIf(function () {
                    return request('email') === null;
                }),
            ],
            'email' => [
                'nullable',
                'email',
                'exists:clients,email',
                Rule::requiredIf(function () {
                    return request('phone') === null;
                }),
            ],
        ];
    }
}
