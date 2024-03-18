<div>
    <div class="mobile-profile-area" style="display: {{$profileDisplay}};">
        <div class="mobile-cart-header default-flex-between">
            <a class="default-flex" wire:click="showProfileTab()">
                <i class='bx bx-chevron-left'></i>
            </a>

            <h3>{{$user->name}}</h3>
        </div>

        <div class="profile-menu-area">
            <ul class="profile-menu-area-list">
                <li>
                    <p class="profile-menu-item">
                        Meus dados
                    </p>
                </li>

                <li>
                    <p class="profile-menu-item">
                        Meus Pedidos
                    </p>
                </li>

                <li>
                    <p class="profile-menu-item">
                        Meus Favoritos
                    </p>
                </li>

                <li>
                    <a href="{{route('logout', $user->id)}}">
                        Sair
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
