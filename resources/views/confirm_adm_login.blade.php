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
                        @foreach ($errors->all() as $error)
                            <h4 class="warning-item">{{$error}}</h4>
                        @endforeach
                    @else <h4 class="confirm-login-title">Enviamos um e-mail com o código de segurança!</h4>

                    @endif
                </div>

                <div class="login-form-inputs-area">
                    <form method="POST" action="{{route("confirm.adm.login.action")}}">
                        @csrf

                        <input type="hidden" name="userId" value="{{$userId}}">

                        <div class="input-area">
                            <i class='bx bx-code-alt' style="padding-top: 3px"></i>
                            <input type="
                            " name="code" id="code" placeholder="Digite o seu código">
                        </div>

                        <button class="login-submit-button" type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
