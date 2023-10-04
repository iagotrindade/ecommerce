<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ApiBrasil\Service;

class WhatsAppController extends Controller
{
    public static function sendMessage($number, $text) {
        $response = Service::WhatsApp("sendText", [
            "Bearer" => env('WHATSAPP_API_BEARER'),
            "SecretKey" => env('WHATSAPP_API_SECRET_KEY'),
            "PublicToken" => env('WHATSAPP_API_PUBLIC_TOKEN'),
            "DeviceToken" => env('WHATSAPP_API_DEVICE_TOKEN'),
            "body" => [
                "number" => $number,
                "text" => $text
            ]
        ]);
    }
}
