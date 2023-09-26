<?php

namespace App\Http\Traits;

trait ApiResponse
{


    public function api($data = null, $status = null, array $message = null)
    {

        $data2 = [
            'data' => $data,
            'status' => $status,
            'message' => $message
        ];

        return response($data2, $status, $message);
    }
    public function token($user, $token)
    {
        $data2 = [

            'user' => $user,
            'token' => $token,
            'message' => 'login Sucessfully'
        ];
        return response($data2, 200, ["login Sucessfully"]);
    }
}
