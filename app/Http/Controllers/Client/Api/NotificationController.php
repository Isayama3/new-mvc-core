<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Controllers\API\Controller;
use App\Models\ClientNotification as Model;
use App\Http\Requests\Client\Api\ClientNotificationRequest as FormRequest;
use App\Http\Resources\Client\ClientNotificationResource as Resource;

class NotificationController extends Controller
{
    public function __construct(FormRequest $request, Model $model, $resource = Resource::class)
    {
        parent::__construct(
            $request,
            $model,
            $resource,
            hasDelete: true
        );
    }

    public function relations(): array
    {
        return [
            'client',
        ];
    }

    public function customWhen(): array
    {
        return [
            'condition' => true,
            'callback' => function ($q) {
                return $q->where('id', auth()->guard('client-api')->id());
            },
        ];
    }
}
