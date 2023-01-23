<?php

namespace App\Http\Controllers\Api;

use App\Events\LoginUserEvent;
use App\Events\NewUserCreatedEvent;
use App\Http\Controllers\Controller;
// use Dotenv\Validator;
use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginMail;
use App\Mail\RegisterMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;




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

        NewUserCreatedEvent::dispatch($user);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        // Mail::to($user->email)->send(new RegisterMail($user));
       
        
        return response(['status'=>'true','data'=>$success ,'message'=>'User registration successfully'],200);

            
    }
//login 
    public function login(Request $request){
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            // Mail::to($user->email)->send(new LoginMail($user));
            // NewUserCreatedEvent::dispatch($user);
            LoginUserEvent::dispatch($user);
            
            Notification::send($user, new WelcomeNotification);
           
            return response(['status'=>true,'data'=>$success ,'message'=>'User Login successfully'],200);

            }else
            {
            return response(['status'=>false ,'message'=>'Unauthorised user']);
            }
            
    }


    public function sendVerifyMail($email , Request $request)
    {
        $this->middleware('auth:sanctum');

        // $user = Auth::user();

        if($request->user()){


           $user =  User::where('email', $email)->get();
            if(count($user) > 0){ 
                // $data['email'] = $email;
                $data['title'] = "Email verification";
                $data['body'] = "plese click to  verify your mail";
                Mail::send('mail', ['data' => $data],function($message) use ($data){
                    $message ->to($data['email'])->subject($data['title']);
                });
            }else{ 
                return response(['status'=>false ,'message'=>'user is not found']);
            }
        }
        else{
        return response(['status'=>false ,'message'=>'user is not authorized']);
        }
    }


    public function admin(){
        return view('admin');
    }
    
}
