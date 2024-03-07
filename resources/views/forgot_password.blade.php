<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" href="/assets/css/style.css"/>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <title>Painel Administrativo - Confirmação de Login</title>
    </head>

    <body class="adm-body">
        <div class="panel-container default-flex-around">
            <div class="login-form-area default-flex-column">
                <div class="login-form-header-area default-flex-column">
                    <img src="{{url("assets/images/panel-images/login-icon-image.png")}}" alt="ícone">

                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="warning-item">{{$error}}</li>
                            @endforeach
                        </ul>

                    @else <h2 class="confirm-login-title">Recuperar Senha</h2>

                    @endif
                </div>

                <div class="login-form-inputs-area">
                    <form method="POST" action="{{route('forgot.password.action')}}">
                        @csrf
                        <div class="input-area">
                            <div class="">
                                <i class='bx bx-user'></i>
                                <input class="login-form-inputs-area-input" type="text" name="email" id="email" placeholder="Digite seu E-mail" required>
                            </div>
                        </div>

                        <button class="login-submit-button" type="submit">Enviar</button>

                        <div class="remembered-password-link-area default-flex">
                            <a href="{{route('login')}}">Lembrou sua senha? Clique aqui</a>
                        </div>
                    </form>
                </div>
            </div>

            <img class="login-image" src="{{url('/assets/images/panel-images/login-image.png')}}" alt="Login Image">
        </div>
    </body>
</html>
