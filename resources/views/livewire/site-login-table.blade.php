<div>
    <div class="login-tab-wrapper">
        <div class="login-tab-icon default-flex">
            <i class='bx bxs-chevron-down' wire:click="showLoginTab()"></i>
        </div>

        <div class="login-tab-container" id="notificationContainer" style="display: {{$loginTabDisplay}}">
            <div class="login-tab-area">
                <div class="site-login-form-inputs-area">
                    <form method="POST" action="{{route('login.action')}}">
                        @csrf
                        <div class="input-area">
                            <div class="">
                                <i class='bx bx-user' id="site-login-icon"></i>
                                <input class="site-login-form-inputs-area-input" type="text" name="email" id="email" placeholder="Digite seu E-mail" required>
                            </div>

                            <div class="">
                                <i class='bx bxs-lock' id="site-login-icon"></i>
                                <input class="site-login-form-inputs-area-input" type="password" name="password" id="password" placeholder="Digite sua Senha" required>
                            </div>

                            <div class="default-flex-between remember-input-area">
                                <div class="default-flex-start">
                                    <input class="remeber-input" type="checkbox" name="remember">
                                    <label class="remeber-label" for="remember">Lembrar-me</label>
                                </div>

                                <button class="login-submit-button" type="submit">Enviar</button>
                            </div>

                            <div class="site-forgot-password-link-area default-flex">
                                <a href="{{route('forgot.password')}}">Esqueceu sua senha? Clique aqui</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
