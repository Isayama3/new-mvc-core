<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Traits\Response\SendResponse;
use App\Http\Requests\Client\Api\NotificationRequest;
use App\Http\Resources\Client\NotificationResource;

class NotificationController
{
    use SendResponse;

    public function index()
    {
        $record = auth()->guard('client-api')->user()->notifications->paginate(request()->per_page ?? 10);
        return $this->sendResponse(
            NotificationResource::collection($record),
            withmeta: true,
        );
    }

    public function show($id)
    {
        $record = auth()->guard('client-api')->user()->notifications()->findOrFail($id);
        return $this->sendResponse(NotificationResource::make($record));
    }

    public function destroy($id)
    {
        $model = auth()->guard('client-api')->user()->notifications()->findOrFail($id);
        $model->delete();
        return $this->SuccessMessage(__('client.successfully_deleted'));
    }
}
