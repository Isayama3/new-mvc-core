<?php

namespace App\Base\Request\Api;

use Illuminate\Support\Facades\Auth;
use App\Base\Traits\Response\SendResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientBaseRequest extends FormRequest
{
    use SendResponse;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (app()->runningInConsole()) {
            return true;
        }
        return Auth::guard('client-api')->check();
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->ErrorValidate(
            $validator->errors()->toArray(),
        ));
    }
}
