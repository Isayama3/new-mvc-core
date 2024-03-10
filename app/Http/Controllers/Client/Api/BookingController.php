<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\Booking as Model;
use App\Http\Requests\Client\Api\BookingRequest as FormRequest;
use App\Http\Resources\Client\BookingResource as Resource;

class BookingController extends Controller
{
    public function __construct(FormRequest $request, Model $model, $resource = Resource::class)
    {
        parent::__construct(
            $request,
            $model,
            $resource
        );
    }

    public function relations(): array
    {
        return [
            'service',
        ];
    }
}
