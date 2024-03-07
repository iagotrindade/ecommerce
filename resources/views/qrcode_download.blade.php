<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
        @livewireStyles

        <title>Dashboard - Baixar QRCode</title>
    </head>

    <body>
        <div class="qrcode-view default-flex">
            {{Str::of($qrcode->qrcode)->toHtmlString()}}
        </div>
    </body>
</html>


