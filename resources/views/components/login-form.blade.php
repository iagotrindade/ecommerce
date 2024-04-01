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

<div class="default-flex login-form-inputs-area">
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
