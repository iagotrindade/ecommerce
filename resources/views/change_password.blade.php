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

                    @else <h2 class="confirm-login-title">Alteração de Senhas</h2>

                    @endif
                </div>

                <div class="login-form-inputs-area">
                    <form method="POST" action="{{route('password.reset.action')}}">
                        @csrf

                        <input type="hidden" name="token" id="token" value="{{$token}}">

                        <div class="input-area">
                            <div class="">
                                <i class='bx bx-user'></i>
                                <input class="login-form-inputs-area-input" type="text" name="email" id="email" placeholder="Digite seu E-mail" required>
                            </div>

                            <div class="">
                                <i class='bx bxs-lock'></i>
                                <input class="login-form-inputs-area-input" type="password" name="password" id="password" placeholder="Digite a nova senha" required>
                            </div>

                            <div class="">
                                <i class='bx bxs-lock'></i>
                                <input class="login-form-inputs-area-input" type="password" name="password_confirmation" id="password" placeholder="Confirme a nova senha" required>
                            </div>
                        </div>

                        <button class="login-submit-button" type="submit">Enviar</button>
                    </form>
                </div>
            </div>

            <img class="login-image" src="{{url('/assets/images/panel-images/login-image.png')}}" alt="Login Image">
        </div>
    </body>
</html>
