<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class MailController extends Controller
{
    //

    public function index(){
        //   try{
            $send = Mail::send('mail.demo', [], function ($message) {
               /*
                $message->from('john@johndoe.com', 'John Doe');
                $message->sender('john@johndoe.com', 'John Doe');
                $message->to('john@johndoe.com', 'John Doe');
                $message->cc('john@johndoe.com', 'John Doe');
                $message->bcc('john@johndoe.com', 'John Doe');
                $message->replyTo('john@johndoe.com', 'John Doe');
                $message->subject('Subject');
                $message->priority(3);
                $message->attach('pathToFile');
                */
            //     $message->to('akshay8593995890@gmail.com', 'Akshay');


            //   $message->subject('test subject');
           
            // //    $message->to(User::find(3)->email);
            // $data = User::find(3)->email;



                // $message->to(User::all()->where('email', 3));
                // $message->to(User::select('email')->pluck('email')->where('id','=' ,3));
                // $message->to(User::where('email',3)->get());    
                // $message->to(User::select('email', 'name')->where('id',3)->get()); 
    
                // $message->to(User::find(1)->where('email', 1)->first());

            }); 




            // } catch(\Exception $e){
            //     echo $e->getMessage();
            // }
            // var_dump($send);

        // return $data;
        }

        public function test(){
            // $test = User::find(3);
            // $test = User::select('email')->first();
            // $test = User::select('email', 'name')->where('id',3)->get();
            // $test = User::all()->find(1)->get('email');

            // var_dump($test);
    }


}
