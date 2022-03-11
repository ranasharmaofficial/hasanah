<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendRegistrationMail($name, $verificationcode, $email, $euserid){
        $data = [
            'name' => $name,
            'verification_code' => $verificationcode,
            'userid' => $euserid,
        ];
        Mail::to($email)->send(new RegistrationMail($data));
    }
}
