<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use App\Base\Traits\Response\SendResponse;
use App\Http\Resources\Client\ClientAddressResource;
use App\Http\Resources\Client\ClientCarResource;

class DefaultCarAddressController extends Controller
{
    use SendResponse;

    public function getClientCars()
    {
        $records = auth()->guard('client-api')->user()->cars->paginate(request()->per_page ?? 10);
        return $this->sendResponse(
            ClientCarResource::collection($records),
            withmeta: true,
        );
    }
    public function setDefaultCar()
    {
    }

    public function getClientAddress()
    {
        $records = auth()->guard('client-api')->user()->cars->paginate(request()->per_page ?? 10);
        return $this->sendResponse(
            ClientAddressResource::collection($records),
            withmeta: true,
        );
    }
    public function setDefaultAddress()
    {
    }
}
