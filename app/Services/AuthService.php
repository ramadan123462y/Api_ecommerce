<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService
{


    use ApiResponse;

    public function update_profile($request, $guard = 'apiadmin', $model = 'admin')
    {


        $validation = $this->validation_update($request, $model);


        if ($validation->fails()) {
            return $this->api(null, 400, [$validation->errors()]);
        } else {
            return $this->updateuser($request, $guard);
        }
    }






    public function login($request, $guard)
    {
        try {
            $validation = $this->validation_login($request);
            if ($validation->fails()) {
                return $this->api(null, 400, [$validation->errors()]);
            } else {
                return $this->check_attempt($request, $guard);
            }
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()]);
        }
    }



    public function profile($guard)
    {
        try {
            return response()->json(Auth::guard($guard)->user());
        } catch (\Exception $e) {

            return response()->json(['message' => $e->getMessage()]);
        }
    }





    public function register($request, $model)
    {
        try {
            $validation = $this->validation_register($request, $model);

            if ($validation->fails()) {
                return $this->api(null, 400, [$validation->errors()]);
            } else {

                $user = $this->create_user($request, $model);
                return $this->api($user, 200, ["user Register Successfully"]);
            }
        } catch (\Exception $e) {

            return $this->api(null, 500, [$e->getMessage()]);
        }
    }



    public function validation_register($request, $model)
    {

        if ($model == 'admin') {

            $validation = Validator::make($request->all(), [
                'email' => 'required|unique:admins,email',
                'name' => 'required',
                'password' => 'required',
            ]);
            return $validation;
        } else {
            $validation = Validator::make($request->all(), [
                'email' => 'required|unique:users,email',
                'name' => 'required',
                'password' => 'required',
            ]);
            return $validation;
        }
    }
    public function create_user($request, $model)
    {
        if ($model == 'admin') {

            $user = Admin::create([

                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $user = User::create([

                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        }


        return $user;
    }
















    public function check_attempt($request, $guard)
    {
        if (!$token = Auth::guard($guard)->attempt(['email' => $request->email, 'password' => $request->password])) {


            return $this->api(null, 400, ["user not found "]);
        } else {
            $user = ['email' => $request->email, 'password' => $request->password];

            return $this->token($user, $token);
        }
    }




    public function validation_login($request)
    {

        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',


        ]);
        return $validation;
    }
    public function validation_update($request, $model = 'admin')
    {

        if ($model == 'admin') {

            $validation = Validator::make($request->all(), [
                'email' => 'required|unique:admins,email,' . Auth::guard('apiadmin')->user()->id,
                'name' => 'required',
                'password' => 'required',
            ]);
        } else {
            $validation = Validator::make($request->all(), [
                'email' => 'required|unique:users,email,' . Auth::guard('api')->user()->id,
                'name' => 'required',
                'password' => 'required',
            ]);
        }
        return $validation;
    }

    public function updateuser($request, $guard)
    {

        if ($guard == 'apiadmin') {
            $user = Admin::find(Auth::guard($guard)->user()->id);
        } else {

            $user = User::find(Auth::guard($guard)->user()->id);
        }

        if ($user) {

            $user->update([

                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,

            ]);
            return $this->api($user, 200, ['user updated  Successfully']);
        } else {

            return $this->api(null, 400, ['user not found']);
        }
    }
    public function logout($guard)
    {

        Auth::guard($guard)->logout();
        return $this->api([], 200, ['loged out Sucessfully']);
    }
}
