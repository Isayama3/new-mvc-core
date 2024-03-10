<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class ClientRequest extends AdminBaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name' => 'required|string|max:100',
                        'email' => 'required|unique:clients,email|email|string|max:100',
                        'phone' => 'required|unique:clients,phone|numeric',
                        'password' => 'required|confirmed|string|min:8|max:100',
                        'image' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
                    ];
                }
            case 'PUT': {
                    return [
                        'name' => 'nullable|string|max:100',
                        'email' => 'nullable|unique:clients,email,'.$this->client.'|email|string|max:100',
                        'phone' => 'nullable|unique:clients,phone,'.$this->client.'|numeric',
                        'password' => 'nullable|confirmed|string|min:8|max:100',
                        'image' => 'nullable|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),

                    ];
                }
        }
    }
}
