<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class ClientCarRequest extends AdminBaseRequest
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
                        'plate_number' => 'required|numeric',
                        'model' => 'required|string',
                        'plate_source' => 'required|string',
                        'year' => 'required|numeric',
                        'plate_code' => 'required|string',
                        'color' => 'required|string',
                        'client_name' => 'required|string',
                        'client_phone' => 'required|string',
                        'client_id' => 'required|exists:clients,id',
                        'brand_id' => 'required|exists:brands,id',
                        'media' => 'required|array',
                        'media.*' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
                    ];
                }
            case 'PUT': {
                    return [
                        'plate_number' => 'nullable|numeric',
                        'model' => 'nullable|string',
                        'plate_source' => 'nullable|string',
                        'year' => 'nullable|numeric',
                        'plate_code' => 'nullable|string',
                        'color' => 'nullable|string',
                        'client_name' => 'nullable|string',
                        'client_phone' => 'nullable|string',
                        'client_id' => 'nullable|exists:clients,id',
                        'brand_id' => 'nullable|exists:brands,id',
                        'media' => 'nullable|array',
                        'media.*' => 'nullable|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
                    ];
                }
        }
    }
}
