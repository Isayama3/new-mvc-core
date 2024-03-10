<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class BrandRequest extends AdminBaseRequest
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
                        'name_ar' => 'required|unique:brands,name_ar',
                        'name_en' => 'required|unique:brands,name_en',
                        'image' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
                    ];
                }
            case 'PUT': {
                    return [
                        'name_ar' => 'nullable|unique:brands,name_ar,' . $this->brand,
                        'name_en' => 'nullable|unique:brands,name_en,' . $this->brand,
                        'image' => 'nullable|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),

                    ];
                }
        }
    }
}
