<?php

namespace App\Http\Handlers;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeHandler {
    public static function generate($name) {
        $qrcode = QrCode::size(300)
            ->backgroundColor(255, 255, 255)
            ->color(80, 65, 188)
            ->margin(2)
        ->generate(url($name));

        $startPosition = strpos($qrcode, '<svg');
        $svg = substr($qrcode, $startPosition);

        return $svg;
    }
}
