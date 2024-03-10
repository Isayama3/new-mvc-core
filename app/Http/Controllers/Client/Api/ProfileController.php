<?php

namespace App\Http\Controllers\Client\Api;

use App\Base\Traits\Response\SendResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Api\ChangePasswordRequest;
use App\Http\Requests\Client\Api\UpdateProfileRequest;
use App\Http\Resources\Client\ClientResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use SendResponse;

    public function getProfile()
    {
        return $this->shortSuccess(data: ClientResource::make(auth()->guard('client-api')->user()));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $client = auth()->guard('client-api')->user();

        $client->update(Arr::except($request->validated(), 'image'));

        if (request()->has('image') && !is_null(request()->image)) {
            @unlink(storage_path(str_replace('storage/', 'app/public/', $client->image)));
            $path = request()->file('image')->store('public');
            $client->image = str_replace('public/', 'storage/', $path);
            $client->save();
        }

        return $this->shortSuccess(
            msg: __('client.profile_updated_successfully'),
            data: ClientResource::make($client)

        );
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $client = auth()->guard('client-api')->user();

        if (!Hash::check($request->post('old_password'), $client->password))
            return $this->ErrorMessage(__('client.incorrect_password_!'));

        $client->update(['password' => $request->password]);
        return $this->shortSuccess(msg: __('client.password_changed_successfully'));
    }
}
