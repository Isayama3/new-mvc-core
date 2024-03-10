<?php

namespace App\Http\Requests\Admin\Web;

use App\Base\Request\Web\AdminBaseRequest;

class DeliveryPlanRequest extends AdminBaseRequest
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
                        'name_ar' => 'required|string|unique:delivery_plans,name_ar',
                        'name_en' => 'required|string|unique:delivery_plans,name_en',
                        'description_ar' => 'required|string|unique:delivery_plans,description_ar',
                        'description_en' => 'required|string|unique:delivery_plans,description_en',
                        'price' => 'required|min:0|integer',
                    ];
                }
            case 'PUT': {
                    return [
                        'name_ar' => 'nullable|string|unique:delivery_plans,name_ar,' . $this->delivery_plan,
                        'name_en' => 'nullable|string|unique:delivery_plans,name_en,' . $this->delivery_plan,
                        'description_ar' => 'nullable|string|unique:delivery_plans,description_ar,' . $this->delivery_plan,
                        'description_en' => 'nullable|string|unique:delivery_plans,description_en,' . $this->delivery_plan,
                        'price' => 'nullable|min:0|integer',
                    ];
                }
        }
    }
}
