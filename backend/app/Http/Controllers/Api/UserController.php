<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request, string $id)
    {
        $what = $request['what'];
        $user = User::find($id);
        
        switch ($what) {
            case 'pushtoken':
                
                $user->push_token       = $request['push_token'];
                $user->save();

                break;

            case 'password':
                
                $this->validator($request->all())->validate();
                $currentPassword        = $request['current_password'];
                $user->password         = bcrypt($request['password']);
                if (Hash::check($currentPassword, $user->password)) {
                    $user->save();
                    return response()->json(200);
                }

                return response()->json([
                    'current_password' => ['Current password is incorrect.']
                ], 401);
                
                break;

            case 'payment':
                
                $user->bank_name            = $request['bank_name'];
                $user->bank_account_name    = $request['bank_account_name'];
                $user->bank_account_number  = $request['bank_account_number'];
                $user->gcash_number         = $request['gcash_number'];
                $user->gcash_account        = $request['gcash_account'];
                $user->save();

                break;
            
            default:
                
                $this->userValidator($request->all(), $request['id'])->validate();
                $user->name             = $request['name'];
                $user->email            = $request['email'];
                $user->contact_number   = $request['contact_number'];
                $user->birthdate        = $request['birthdate'];
                $user->gender           = $request['gender'];
                $user->address          = $request['address'];
                $user->city             = $request['city'];
                $user->province         = $request['province'];
                $user->postal_zip         = $request['postal_zip'];
                $user->save();

                break;
        }

        return response()->json(200);
    }

    protected function userValidator(array $data, $id)
    {
        return Validator::make($data, [
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'unique:users,email,' . $id . ',id'],
            'contact_number'    => ['required']
        ]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'current_password'  => ['required', 'string', 'max:255'],
            'password'          => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

}
