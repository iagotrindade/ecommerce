<div class="asside-menu-area default-flex-column-start">
    <a class="default-flex logo-image-area" href="{{route('dashboard')}}">
        <img class="logo-image" src="{{url('assets/images/panel-images/logo.png')}}" alt="OverFood">
    </a>

    <div>
        <ul class="sidebar-menu-list">
            <li class="">
                <a href="{{route("orders")}}" class="default-flex-column menu-item @if($activeMenu=='orders') menu-active @endif">
                    <i class="bx bxs-category @if($activeMenu=='orders') menu-active @endif"></i>
                    <p>Pedidos</p>
                </a>
            </li>

            <!--<li class="">
                <a href="" class="default-flex-column menu-item @if($activeMenu=='apperence') menu-active @endif">
                    <i class='bx bx-palette @if($activeMenu=='apperence') menu-active @endif'></i>
                    <p>Aparência</p>
                </a>
            </li>

            <li class="">
                <a href="{{route('gallery')}}" class="default-flex-column menu-item @if($activeMenu=='gallery') menu-active @endif">
                    <i class='bx bxs-camera @if($activeMenu=='gallery') menu-active @endif'></i>
                    <p>Mídia</p>
                </a>
            </li>-->

            <li class="">
                <a href="{{route("carte")}}" class="default-flex-column menu-item @if($activeMenu=='carte') menu-active @endif">
                    <i class="bx bx-food-menu @if($activeMenu=='carte') menu-active @endif"></i>
                    <p>Cardápio</p>
                </a>
            </li>

            <li class="">
                <a href="{{route('qrcode')}}" class="default-flex-column menu-item @if($activeMenu=='qrcodes') menu-active @endif">
                    <i class='bx bx-qr-scan @if($activeMenu=='qrcodes') menu-active @endif'></i>
                    <p>Mesas</p>
                </a>
            </li>

            <li class="">
                <a href="{{route('users')}}" class="default-flex-column menu-item @if($activeMenu=='users') menu-active @endif">
                    <i class='bx bxs-group @if($activeMenu=='users') menu-active @endif'></i>
                    <p>Usuários</p>
                </a>
            </li>

            <li class="">
                <a href="{{route('permissions')}}" class="default-flex-column menu-item @if($activeMenu=='permissions') menu-active @endif">
                    <i class='bx bxs-lock @if($activeMenu=='permissions') menu-active @endif'></i>
                    <p>Permissões</p>
                </a>
            </li>

            <!--<li class="">
                <a href="" class="default-flex-start menu-item" id="toggle-dropdown-menu-action">
                    <i class='bx bx-package'></i>
                    <p>Produtos</p>
                    <i class='bx bxs-chevron-down' id="toggle-dropdown-menu-arrow"></i>
                </a>

                <div class="dropdown-menu-items-area default-flex-column">
                    <a href="">Produtos</a>
                    <a href="">Categorias</a>
                    <a href="">Estoque</a>
                    <a href="">Variações</a>
                </div>
            </li>-->

            <li class="logout-icon">
                <a href="{{route('logout', $user->id)}}" class="default-flex menu-item">
                    <i class='bx bxs-log-out '></i>
                </a>
            </li>
        </ul>
    </div>
</div>
