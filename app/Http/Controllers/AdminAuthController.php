<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    use ApiResponse;
    protected $authservice;

    public function __construct(AuthService $authservice)
    {
        $this->authservice = $authservice;


    }


    public function register(Request $request)
    {

        return $this->authservice->register($request, 'admin');
    }

    public function profile()
    {
        return $this->authservice->profile('apiadmin');
    }

    public function update_profile(Request $request, $guard = 'apiadmin')
    {
        return $this->authservice->updateuser($request, 'apiadmin');
    }



    public function login(Request $request)
    {
        return $this->authservice->login($request, 'apiadmin');
    }

    public function logout()
    {

        return $this->authservice->logout('apiadmin');
    }
}
