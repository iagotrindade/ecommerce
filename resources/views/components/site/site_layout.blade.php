<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" href="/assets/css/style.css"/>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        @livewireStyles
        <title>Overfood - {{$title}}</title>
    </head>

    <body>
        <div class="default-flex site-container">
            <x-site.site_asside_menu activeMenu="{{$activeMenu}}" :user="$user"></x-site.site_asside_menu>

            <div class="site-content-area">
                <header class="site-header-area default-flex-around">
                    <div class="table-number-area">
                        @if (!empty($tablenumber))
                            <p class="table-number">{{$tablenumber}}</p>
                        @endif
                    </div>

                    <form method="POST" action="" class="adm-search-form">
                        <livewire:search-site-items-input/>
                    </form>

                    <livewire:cart-count-area/>

                    <div class="site-profile-area default-flex">
                        @if (Auth::check())
                            <a href="{{route('profile')}}" class="default-flex">
                                <img src="{{url("storage/{$user->image}")}}" alt="Avatar">
                            </a>

                            <h3>{{$user->name}}</h3>

                            <livewire:user-float-menu :user="$user"></livewire:user-float-menu>
                        @else
                            <h3>FAÇA LOGIN</h3>

                            <livewire:site-login-table>
                        @endif
                    </div>
                </header>

                {{$slot}}
            </div>
        </div>

        <livewire:cart-summary>

        <script>
            function toggleMenu() {
                var cartSumary = document.getElementById('cart-summary-menu');

                cartSumary.style.right = (cartSumary.style.right === '0px') ? '-400px' : '0px';
            }
        </script>
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
        <script src="assets/js/site.js"></script>
        @livewireScripts
    </body>
</html>
