<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
// use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;
use App\Mail\RegisterMail;


class AuthController extends Controller
{
    //

    
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        Mail::to($user->email)->send(new RegisterMail($user));
        return response(['status'=>'true','data'=>$success ,'message'=>'User registration successfully'],200);

            
    }

    public function login(Request $request){
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            Mail::to($user->email)->send(new LoginMail($user));
           
            return response(['status'=>true,'data'=>$success ,'message'=>'User Login successfully'],200);

            }else
            {
            return response(['status'=>false ,'message'=>'Unauthorised user']);
            }
            
    }
}
