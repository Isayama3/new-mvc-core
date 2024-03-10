<?php

namespace App\Http\Controllers\Client\Api\Auth;

use App\Base\Traits\Response\SendResponse;
use App\Http\Requests\Client\Api\Otp\SendOTPRequest;
use App\Http\Requests\Client\Api\Otp\VerifyOTPRequest;
use App\Http\Resources\Client\ClientResource;
use App\Models\Client;
use App\Models\Otp;
use Carbon\Carbon;

class OTPController
{
    use SendResponse;

    public function sendOTP(SendOTPRequest $request)
    {
        // TODO :: Delete this temporary otp
        // $otp = mt_rand(1000, 9999);
        $otp = 1234;
        $otp_receiver = $request->phone ? ['phone' => $request->phone] : ['email' => $request->email];

        Otp::updateOrCreate([
            ...$otp_receiver
        ], [
            'otp' => $otp,
            'valid_until' => Carbon::now()->addMinutes(5)
        ]);

        // TODO :: Send otp here rather than as sms or mail.

        return $this->shortSuccess(msg: __('client.otp_send_successfully'));
    }

    public function verifyOTP(VerifyOTPRequest $request)
    {
        $otp = Otp::where('otp', $request->otp)->where(function ($q) use ($request) {
            $q->where('phone', $request->phone)
                ->where('email', $request->email);
        })->first();

        if (!$otp)
            return $this->ErrorMessage(msg: __('client.invalid_otp'));

        if ($otp->valid_until < Carbon::now())
            return $this->ErrorMessage(msg: __('client.expired_otp.'));

        $otp->update(['verified' => 1]);

        $client = Client::where(function ($q) use ($otp) {
            $q->where('phone', $otp->phone)
                ->orWhere('email', $otp->email);
        })->first();

        $token = $client->createToken($client->name . '-AuthToken')->plainTextToken;

        return $this->shortSuccess(
            data: [
                'token' => $token,
                'client' => new ClientResource($client)
            ],
            msg: __('client.otp_verified_successfully.')
        );
    }
}
