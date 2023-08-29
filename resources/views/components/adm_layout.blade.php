<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        @livewireStyles

        <title>Dashboard - {{$title}}</title>
    </head>

    <body>
        <div class="default-flex dashboard-container">
            <x-adm_asside_menu activeMenu="{{$activeMenu}}"></x-adm_asside_menu>

            <div class="dashboard-content-area">
                <x-adm_header title="{{$title}}" userName="{{$userName}}" userImage="{{$userImage}}"></x-adm_header>
                {{$slot}}
            </div>
        </div>

        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        @livewireScripts
        <script src="assets/js/adm.js"></script>
    </body>
</html>
