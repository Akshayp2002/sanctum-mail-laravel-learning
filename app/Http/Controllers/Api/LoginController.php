<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;


class LoginController extends Controller
{
    //
    public function login(LoginRequest $request){

        return true;  

    }
}
