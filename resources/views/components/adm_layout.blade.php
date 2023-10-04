<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/css/style.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        @livewireStyles

        <title>Dashboard - {{$title}}</title>
    </head>

    <body>
        <div class="default-flex dashboard-container">
            <x-adm_asside_menu activeMenu="{{$activeMenu}}"></x-adm_asside_menu>

            <div class="dashboard-content-area">
                <header class="dashboard-header-area">
                    <div class="default-flex-around">
                        <div class="page-tittle default-flex">
                            <h1>{{$title}}</h1>
                        </div>

                        <form method="POST" action="" class="adm-search-form">
                            <livewire:search-items-input searchFunction="{{$pastSearchFunction}}"/>
                        </form>

                        <livewire:header-notification-area/>

                        <div class="adm-profile-area default-flex">
                            <a href="{{route('profile')}}" class="default-flex">
                                <img src="{{{url("storage/$userImage")}}}" alt="Avatar">
                            </a>

                            <h3>{{$userName}}</h3>
                        </div>
                    </div>
                </header>

                {{$slot}}
            </div>

            <div class="pusher-alert-area default-flex-column">
                <div class="pusher-modal">
                    <div class="default-flex-end">
                        <i class='close-notification-modal bx bx-x-circle' ></i>
                    </div>

                    <div class="default-flex-start">
                        <i class='bx bxs-bell-ring'></i>
                        <h2>Alerta de Nova Notificação!</h2>
                    </div>

                    <p class="pusher-alert-message">Um novo usuário foi cadastrado no Painel Administrativo</p>
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <script src="assets/js/adm.js"></script>
        <script src="js/app.js"></script>

        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('d4ff3fc0bb0cbb29ff4f', {
              cluster: 'sa1'
            });

            var channel = pusher.subscribe('notification-chanel');
            channel.bind('panel-notification', function(data) {
                console.log(data);
                let pusherModal = document.querySelector('.pusher-alert-area');
                let pusherModalMessage = document.querySelector('.pusher-alert-message');
                setTimeout(() => {
                    pusherModal.style.display = 'flex';
                    pusherModalMessage.innerText = JSON.stringify(data['message']);
                }, "0");
            });
        </script>
        @livewireScripts
    </body>
</html>
