<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" media="(max-width: 1200px)" href="/assets/css/m_style.css"/>
        <link rel="stylesheet" media="(max-width: 950px)" href="/assets/css/t_style.css"/>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        @livewireStyles

        <title>Dashboard - {{$title}}</title>
    </head>

    <body>
        <div class="default-flex dashboard-container">
            <x-adm_asside_menu activeMenu="{{$activeMenu}}" :user="$user"></x-adm_asside_menu>

            <div class="dashboard-content-area">
                <header class="dashboard-header-area">
                    <div class="default-flex-around">
                        <div class="page-tittle default-flex">
                            <h1>{{$title}}</h1>
                        </div>

                        <form method="POST" action="" class="adm-search-form">
                            <livewire:search-items-input/>
                        </form>

                        <livewire:header-notification-area :user="$user"/>

                        <div class="adm-profile-area default-flex">
                            <a href="{{route('profile')}}" class="default-flex">
                                <img src="{{{url("storage/$user->image")}}}" alt="Avatar">
                            </a>

                            <h3>{{$user->name}}</h3>
                        </div>
                    </div>
                </header>

                {{$slot}}
            </div>
        </div>

        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <script src="assets/js/adm.js"></script>
        @livewireScripts
    </body>
</html>
