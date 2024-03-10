<?php

namespace App\Http\Controllers\Client\Api\Auth;

use App\Base\Traits\Response\SendResponse;
use App\Http\Requests\Client\Api\Auth\ForgetPasswordRequest;
use App\Http\Requests\Client\Api\Auth\LoginRequest;
use App\Http\Requests\Client\Api\Auth\RegisterRequest;
use App\Http\Resources\Client\ClientResource;
use App\Models\Client;
use App\Models\Otp;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    use SendResponse;

    public function login(LoginRequest $request)
    {
        $client = Client::whereEmail($request->input('email'))->first();

        if (!$client)
            return $this->ErrorMessage(__('client.email_not_found_!'));

        if (Hash::check($request->input('password'), $client->password)) {
            if ($request->device_token) {
                $client->update([
                    'device_token' => $request->device_token,
                    'os_type' => $request->os_type
                ]);
            }

            $token = $client->createToken($client->name . '-AuthToken')->plainTextToken;
            return $this->shortSuccess(
                data: [
                    'token' => $token,
                    'client' => new ClientResource($client)
                ],
                msg: __('client.logout_successfully')
            );
        }

        return $this->ErrorMessage(__('client.incorrect_password_!'));
    }

    public function register(RegisterRequest $request)
    {
        $client = Client::create(Arr::except($request->validated(), 'image'));

        if (!$client)
            return $this->ErrorMessage();

        if (request()->has('image') && !is_null(request()->image)) {
            $path = request()->file('image')->store('public');
            $client->image = str_replace('public/', 'storage/', $path);
            $client->save();
        }

        $token = $client->createToken($client->name . '-AuthToken')->plainTextToken;

        return $this->shortSuccess(
            data: [
                'token' => $token,
                'client' => new ClientResource($client)
            ],
            msg: __('client.account_created')
        );
    }

    public function forgetPassword(ForgetPasswordRequest $request)
    {
        $otp = Otp::where(function ($q) use ($request) {
            $q->where('email', $request->email)
                ->orWhere('phone', $request->phone);
        })->first();

        if (!$otp)
            return $this->ErrorMessage('client.otp_is_not_registered.');

        if ($otp->verified !== 1)
            return $this->ErrorMessage('client.otp_is_not_verified.');

        $client = Client::where('email', $request->email)->first();
        $client->update(['password' => $request->password]);

        return $this->shortSuccess(msg: __('client.password_updated_successfully'));
    }

    public function logout()
    {
        Auth::guard('client-api')->user()->tokens()->delete();

        return $this->shortSuccess(msg: __('client.logout_successfully'));
    }
}
