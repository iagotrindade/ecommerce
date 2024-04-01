<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" href="/assets/css/style.css"/>
        <link rel="stylesheet" media="(max-width: 1200px)" href="/assets/css/m_style.css"/>
        <link rel="stylesheet" media="(max-width: 950px)" href="/assets/css/t_style.css"/>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <title>Painel Administrativo - Confirmação de Login</title>
    </head>

    <body class="adm-body">
        <div class="panel-container default-flex-around">
            <div class="login-form-area default-flex-column">
                <div class="login-form-header-area default-flex-column">
                    <img src="{{url("assets/images/panel-images/login-icon-image.png")}}" alt="ícone">

                    <h2 class="signin-title">Cadastro</h2>

                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="warning-item">{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="login-form-inputs-area">
                    <form method="POST" action="{{route('signup.action')}}">
                        @csrf
                        <div class="input-area default-flex-column">
                            <div>
                                <i class='bx bx-user'></i>
                                <input class="login-form-inputs-area-input" type="text" name="name" id="name" placeholder="Nome Completo" required>
                            </div>

                            <div>
                                <i class='bx bx-user-pin'></i>
                                <input class="login-form-inputs-area-input" type="text" name="username" id="username" placeholder="Usuário" required>
                            </div>

                            <div>
                                <i class='bx bxs-envelope' ></i>
                                <input class="login-form-inputs-area-input" type="email" name="email" id="email" placeholder="E-mail" required>
                            </div>

                            <div class="default-flex">
                                <button class="signin-submit-button" type="submit">Cadastrar</button>
                            </div>

                            <p class="signin-password-warning">
                                *Após realizar o cadastro, enviaremos uma senha de acesso para o email informado acima!
                            </p>

                            <div class="forgot-password-link-area default-flex">
                                <a href="{{route('login')}}">Já possuí uma conta? Clique aqui</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <img class="login-image" src="{{url('/assets/images/panel-images/login-image.png')}}" alt="Login Image">
        </div>
    </body>
</html>
