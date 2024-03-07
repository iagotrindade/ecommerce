<?php

namespace App\Http\Handlers;
use App\Models\Client;

class ClientHandler {
    public static function clientExists($email) {
        if($email) {
            $user = Client::where('email'. $email)->get();

            return !empty($user) ? $user : false;
        }
    }
}



