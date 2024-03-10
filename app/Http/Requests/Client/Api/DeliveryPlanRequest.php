<?php

namespace App\Http\Requests\Client\Api;

use App\Base\Request\Api\BaseRequest;

class DeliveryPlanRequest extends BaseRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [];
                }
            case 'PUT': {
                    return [];
                }
        }
    }
}
