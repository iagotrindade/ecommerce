<div>
    <div class="login-tab-wrapper">
        <div class="login-tab-icon default-flex">
            <i class='bx bxs-chevron-down' wire:click="showMenu()"></i>
        </div>

        <div class="login-tab-container" id="notificationContainer" style="display: {{$menuDisplay}}">
            <ul class="float-menu-list">
                <li>
                    <a href="">Meus Dados</a>
                </li>

                <li>
                    <a href="">Meus Pedidos</a>
                </li>

                <li>
                    <a href="">Meus Favoritos</a>
                </li>

                <li>
                    <a href="">Endereços</a>
                </li>

                <li>
                    <a href="">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</div>
