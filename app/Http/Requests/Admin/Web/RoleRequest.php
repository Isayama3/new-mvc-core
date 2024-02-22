<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class RoleRequest extends AdminBaseRequest
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
                        'name' => 'required|string|max:255',
                        'email' => 'required|email|unique:admins',
                        'phone' => 'required|string|min:10|max:15',
                        'password' => 'required|string|min:8',
                    ];
                }
            case 'PUT': {
                    return [
                        'name' => 'required|string|max:255',
                        'email' => 'required|email|unique:admins,email,' . $this->admin,
                        'phone' => 'required|string|min:10|max:15',
                        'password' => 'required|string|min:8',
                    ];
                }
        }
    }
}
