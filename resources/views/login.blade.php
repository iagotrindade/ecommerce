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
        <title>Painel Administrativo - Entrar</title>
    </head>

    <body class="adm-body">
        <div class="panel-container default-flex-around">
            <div class="login-form-area default-flex-column">
                <div class="login-form-header-area default-flex-column">
                    <img src="{{url("assets/images/panel-images/login-icon-image.png")}}" alt="ícone">

                    <div class="create_account-area default-flex">
                        <a class="default-flex" href="{{route('signup')}}">Criar uma Conta</a>
                    </div>

                    <div class="or-login-line-area default-flex-around">
                        <div class="or-login-line-left"></div>
                        <p>Ou</p>
                        <div class="or-login-line-right"></div>
                    </div>

                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="warning-item">{{$error}}</li>
                            @endforeach
                        </ul>

                    @else <h2 class="confirm-login-title">LOGIN</h2>

                    @endif
                </div>

                <div class="login-form-inputs-area">
                    <form method="POST" action="{{route('login.action')}}">
                        @csrf
                        <div class="input-area">
                            <div class="">
                                <i class='bx bx-user'></i>
                                <input class="login-form-inputs-area-input" type="text" name="email" id="email" placeholder="Digite seu E-mail" required>
                            </div>

                            <div class="">
                                <i class='bx bxs-lock'></i>
                                <input class="login-form-inputs-area-input" type="password" name="password" id="password" placeholder="Digite sua Senha" required>
                            </div>

                            <div class="default-flex-between remember-input-area">
                                <div class="default-flex-start">
                                    <input class="remeber-input" type="checkbox" name="remember">
                                    <label class="remeber-label" for="remember">Lembrar-me</label>
                                </div>

                                <button class="login-submit-button" type="submit">Login</button>
                            </div>

                            <div class="forgot-password-link-area default-flex">
                                <a href="{{route('forgot.password')}}">Esqueceu sua senha? Clique aqui</a>
                            </div>

                            <a class="enter-without-login-button default-flex" href="{{route('home')}}">Entrar sem Login -> </a>
                        </div>
                    </form>
                </div>
            </div>

            <img class="login-image" src="{{url('/assets/images/panel-images/login-image.png')}}" alt="Login Image">
        </div>
    </body>
</html>
