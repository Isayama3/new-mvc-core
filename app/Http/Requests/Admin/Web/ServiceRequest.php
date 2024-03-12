<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;
use App\Models\Service;

class ServiceRequest extends AdminBaseRequest
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
                        'name_ar' => 'required|string',
                        'name_en' => 'required|string',
                        'description_ar' => 'required|string',
                        'description_en' => 'required|string',
                        'min_price' => 'required|numeric',
                        'max_price' => 'required|numeric',
                        'status' => 'nullable|numeric',
                        'category_id' => 'required|exists:categories,id|numeric',
                        'brands' => 'required|array',
                        'brands.*' => 'required|exists:brands,id',
                        'media' => 'required|array',
                        'media.*' => 'required|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),
                    ];
                }
            case 'PUT': {
                    return [
                        'name_ar' => 'nullable|string',
                        'name_en' => 'nullable|string',
                        'description_ar' => 'nullable|string',
                        'description_en' => 'nullable|string',
                        'min_price' => 'nullable|numeric',
                        'max_price' => 'nullable|numeric',
                        'status' => 'nullable|numeric',
                        'category_id' => 'nullable|exists:categories,id|numeric',
                        'brands' => 'nullable|array',
                        'brands.*' => 'nullable|exists:brands,id',
                        'media' => 'nullable|array',
                        'media.*' => 'nullable|mimes:jpg,png,jpeg,gif,svg,pdf|max:' . config('settings.max_file_upload'),

                    ];
                }
        }
    }

    public function withValidator($validator)
    {
        if (app()->runningInConsole()) {
            return true;
        }

        $validator->after(function ($validator) {
            if ($this->method == 'PUT' && $this->brands) {
                Service::findOrFail($this->service)->brands()->sync($this->brands);;
            }
        });
    }
}
