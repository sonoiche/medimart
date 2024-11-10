<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        
        $email      = $request['email'];
        $user       = User::where('email', $email)->whereIn('role', ['Customer'])->first();
        
        if (!$user) {
            return response(['message' => 'Accouunt not recognize by the system.'], 503);
        }

        // $otp_number = mt_rand(100000, 999999);
        // $user->otp_number = $otp_number;
        $accessToken            = $user->createToken(uniqid())->plainTextToken;
        $user->access_token     = $accessToken;
        $user->save();

        // $this->sendSms($user->contact_number, 'To continue logging in to Ebalnay, your OTP is '.$user->otp_number.'. Never share your OTP to anyone.');

        return response([
            'email'     => $user->email,
            'token'     => $accessToken
        ], 200);
    }

    public function login(Request $request)
    {
        $this->validatorOtp($request->all())->validate();
        
        $contact_number = $request['contact_number'];
        $otp_number     = $request['otp_number'];
        $user           = User::where('contact_number', $contact_number)
            ->where('otp_number', $otp_number)
            ->first();

        if (!$user) {
            return response(['message' => 'Invalid One time password.'], 503);
        }

        $accessToken            = $user->createToken($user->email)->plainTextToken;
        $user->access_token     = $accessToken;
        $user->otp_number       = null;

        if($user->status === null) {
            $user->email_verified_at = now();
            $user->status            = 'Active';
        }

        $user->save();

        $data['token'] = $accessToken;
        return response()->json($data);
    }

    public function resend(Request $request)
    {
        $contact_number = $request['contact_number'];
        $user           = User::where('contact_number', $contact_number)->first();

        // $this->sendSms($user->contact_number, 'To continue logging in to Ebalnay, your OTP is '.$user->otp_number.'. Never share your OTP to anyone.');

        return response()->json(200);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'User logged out successfully'], 200);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'     => ['required'],
            'password'  => ['required']
        ]);
    }

    protected function validatorOtp(array $data)
    {
        return Validator::make($data, [
            'contact_number' => ['required'],
            'otp_number'     => ['required']
        ]);
    }

    private function sendSms($contact_number, $message)
    {
        if($contact_number != '') {
            Curl::to('https://semaphore.co/api/v4/messages')
                ->withData([
                    'apikey'        => config('app.semaphore_api'),
                    'number'        => $this->convertMobileNumber($contact_number),
                    'message'       => $message,
                    'sendername'    => 'SEMAPHORE'
                ])
                ->asJson( true )
                ->post();

            return true;
        }
    }

    private function convertMobileNumber($number)
    {
        $contact_number = explode('/', $number);
        $countryCode = '+63';
        $internationalNumber = preg_replace('/^0/', $countryCode, $contact_number[0]);
        return str_replace(['-', ' '], ['', ''], $internationalNumber);
    }
}
