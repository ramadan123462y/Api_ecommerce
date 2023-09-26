<?php

namespace App\Http\Controllers\ApiFrontend;

use App\Http\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    use ApiResponse;
    public $authservice;
    public function __construct(AuthService $authservice)
    {
        $this->authservice = $authservice;
    }

    public function login(Request $request)
    {
        return  $this->authservice->login($request, 'api');

    }

    public function register(Request $request)
    {
        return  $this->authservice->register($request, 'user');
    }

    public function logout()
    {
        return $this->authservice->logout('api');
    }
    public function profile()
    {
        return $this->authservice->profile('api');
    }
    public function update_profile(Request $request)
    {
        return $this->authservice->updateuser($request, 'api');
    }
}
