<div>
    <div class="menu-mobile">
        <ul class="mobile-menu-list default-flex-around">
            <li>
                <a href="{{route("home")}}" class="default-flex-column">
                    <i class="bx bx-food-menu"></i>
                    <p>Cardápio</p>
                </a>
            </li>

            <li>
                <a class="default-flex-column" wire:click="openMobileNotifications()">
                    @if ($newNotificationCount > 0)
                        <i class='bx bxs-bell-ring bx-tada' style="color: #5041BC;"></i>
                    @else 
                        <i class='bx bxs-bell'></i>
                    @endif
                   
                    <p>Notificações</p>
                </a>
            </li>

            <li class="center-mobile-icon-area">
                <a href="{{route("cart")}}" class="default-flex-column center-mobile-icon">
                    <i class='bx bx-shopping-bag'></i>
                </a>

                @if (session('cart'))
                    <p class="cart-count-area default-flex-end">{{$cartCount}}</p>
                @endif
            </li>

            <li>
                <a class="default-flex-column" wire:click="openMobileSearch()">
                    <i class='bx bx-search-alt-2'></i>
                    <p>Pesquisar</p>
                </a>
            </li>

            <li class="">
                <a class="default-flex-column" wire:click="openProfileTab()">
                    <i class='bx bxs-user'></i>
                    <p>Perfil</p>
                </a>
            </li>
        </ul>
    </div>
</div>
