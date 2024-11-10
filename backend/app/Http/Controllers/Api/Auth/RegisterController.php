<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        
        $otp_number = mt_rand(100000, 999999);

        $user = new User;
        $user->name             = $request['name'];
        $user->email            = $request['email'];
        $user->password         = bcrypt($request['password']);
        $user->role             = 'Customer';
        $user->otp_number       = $otp_number;
        $user->save();
        
        $accessToken            = $user->createToken($user->email)->plainTextToken;
        $user->access_token     = $accessToken;
        $user->save();

        // $this->sendSms($user->contact_number, 'To continue logging in to Pasabim app, your OTP is '.$user->otp_number.'. Never share your OTP to anyone.');
        
        $data['contact_number'] = $user->contact_number;
        $data['token']          = $accessToken;
        return response()->json($data);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email'             => ['required', 'string', 'max:255', 'unique:users'],
            'name'              => ['required', 'string', 'max:255'],
            'password'          => ['required', 'string', 'min:8', 'confirmed']
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
