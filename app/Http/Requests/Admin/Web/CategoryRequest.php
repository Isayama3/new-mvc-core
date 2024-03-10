<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class CategoryRequest extends AdminBaseRequest
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
                        'name_ar' => 'required|unique:categories,name_ar',
                        'name_en' => 'required|unique:categories,name_en',
                        'description_ar' => 'required|unique:categories,description_ar',
                        'description_en' => 'required|unique:categories,description_en',
                        'image' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
                    ];
                }
            case 'PUT': {
                    return [
                        'name_ar' => 'nullable|unique:categories,name_ar,' . $this->category,
                        'name_en' => 'nullable|unique:categories,name_en,' . $this->category,
                        'description_ar' => 'nullable|unique:categories,description_ar,' . $this->category,
                        'description_en' => 'nullable|unique:categories,description_en,' . $this->category,
                        'image' => 'nullable|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),

                    ];
                }
        }
    }
}
