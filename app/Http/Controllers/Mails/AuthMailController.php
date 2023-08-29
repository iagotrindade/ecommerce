<?php

namespace App\Http\Controllers\Mails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\loginCodeMail;

class AuthMailController extends Controller
{
    public static function loginCodeMail($user) {
        $authMail = new loginCodeMail($user);

        Mail::to($user->email)->send($authMail);
    }
}
