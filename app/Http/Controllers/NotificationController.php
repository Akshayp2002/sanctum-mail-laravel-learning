<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //

    public function sms_notification(){
        $basic  = new \Vonage\Client\Credentials\Basic("c6b15af5", "eMfS6y0vSN4Do1pW");
$client = new \Vonage\Client($basic);

$response = $client->sms()->send(
    new \Vonage\SMS\Message\SMS("916238781287", 'Akshay', 'test sms is working ')
);

$message = $response->current();

if ($message->getStatus() == 0) {
    echo "The message was sent successfully\n";
} else {
    echo "The message failed with status: " . $message->getStatus() . "\n";
}
    }
}
