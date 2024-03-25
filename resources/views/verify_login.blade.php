<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel = "stylesheet" href="/assets/css/style.css"/>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" media="(max-width: 1200px)" href="/assets/css/m_style.css"/>
        <link rel="stylesheet" media="(max-width: 950px)" href="/assets/css/t_style.css"/>
        <title>Painel Administrativo - Confirmação de Login</title>
    </head>

    <body class="adm-body">
        <div class="panel-container default-flex-around">
            <div class="panel-container default-flex-around">
                <div class="login-form-area default-flex-column">
                    <div class="login-form-header-area default-flex-column">
                        <img src="{{url("assets/images/panel-images/login-icon-image.png")}}" alt="ícone">

                        <h2 class="confirm-login-title">Digite seu código de verificação</h2>
                    </div>

                    <div class="login-form-inputs-area">
                        <form method="POST" action="{{route('confirm.login.action')}}" class="verification-code-input default-flex-column">
                            <div class="verify-code-input-area">
                                @csrf
                                @if ($errors->any())
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="warning-item">{{$error}}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <input type="hidden" name="userId" value="{{$userId}}">
                                <input type="text" maxlength="1" pattern="\d" inputmode="numeric" name="code[]"/>
                                <input type="text" maxlength="1" pattern="\d" inputmode="numeric" name="code[]"/>
                                <input type="text" maxlength="1" pattern="\d" inputmode="numeric" name="code[]"/>
                                <input type="text" maxlength="1" pattern="\d" inputmode="numeric" name="code[]"/>
                                <input type="text" maxlength="1" pattern="\d" inputmode="numeric" name="code[]"/>
                                <input type="text" maxlength="1" pattern="\d" inputmode="numeric" name="code[]"/>
                            </div>

                            <div class="send-verification-code-button-area default-flex-column">
                                <x-buttons.default_primary_button text="Enviar" tag='button' type='submit'></x-buttons.default_primary_button >

                                <div class="forgot-password-link-area default-flex" style="margin-top: 30px">
                                    <a href="{{route('resend.verification.code', $userId)}}">Seu código não chegou? Clique aqui para reenviar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <img class="login-image" src="{{url('/assets/images/panel-images/login-image.png')}}" alt="Login Image">
            </div>
        </div>

        <script>
            document.addEventListener('input', function (e) {
                const input = e.target;
                if (input.maxLength === input.value.length) {
                    const nextInput = input.nextElementSibling;
                    if (nextInput) {
                        nextInput.focus();
                    }
                }
            });
        </script>
    </body>
</html>
