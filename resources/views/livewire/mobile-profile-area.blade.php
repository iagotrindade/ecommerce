<div>
    <div class="mobile-profile-area" style="display: {{$profileDisplay}};">
        <div class="mobile-cart-header default-flex-between">
            <a class="default-flex" wire:click="showProfileTab()">
                <i class='bx bx-chevron-left'></i>
            </a>

            @if(Auth::check())
                <h3>{{$user->name}}</h3>
            @else
                <h3>Perfil</h3>
            @endif
        </div>

        @if(Auth::check())
            <div class="profile-menu-area">
                <ul class="profile-menu-area-list">
                    <li class="profile-menu-item" wire:click="showMyDataTab()">
                        <p>
                            Meus dados
                        </p>
                    </li>

                    <li class="profile-menu-item" wire:click="showMyOrdersTab()">
                        <p>
                            Meus Pedidos
                        </p>
                    </li>

                    <li class="profile-menu-item" wire:click="showMyFavoritesTab()">
                        <p>
                            Meus Favoritos
                        </p>
                    </li>

                    <li class="profile-menu-item mobile-logout-button-area">
                        <a href="{{route('logout', $user->id)}}" class="mobile-logout-button">
                            Sair
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mobile-profile-my-data-tab" style="display: {{$myDataDisplay}};">
                <div class="mobile-cart-header default-flex-between">
                    <a class="default-flex" wire:click="showMyDataTab()">
                        <i class='bx bx-chevron-left'></i>
                    </a>

                    <h3>{{$user->name}}</h3>
                </div>

                <div class="mobile-edit-user-data">
                    <form action="">
                        <h4>Informações Pessoais</h4>

                        <div class="mobile-user-data">
                            <div class="cart-shipping-area-input-group default-flex-around">
                                <div class="shipping-input-item default-flex-column w-100">
                                    <label for="name">Nome</label>
                                    <input class="w-100" type="text" name="name" id="name" value="{{$user->name}}">
                                </div>

                                <div class="shipping-input-item default-flex-column w-100">
                                    <label for="user">Usuário</label>
                                    <input class="w-100" type="text" name="user" id="user" value="{{$user->username}}">
                                </div>
                            </div>
                        </div>

                        <h4>Dados de Contato</h4>

                        <div class="mobile-user-data">
                            <div class="cart-shipping-area-input-group default-flex-around">
                                <div class="shipping-input-item default-flex-column w-100">
                                    <label for="email">E-Mail</label>
                                    <input class="w-100" type="email" name="email" id="email" value="{{$user->email}}">
                                </div>

                                <div class="shipping-input-item default-flex-column w-100">
                                    <label for="phone">Whatsapp</label>
                                    <input class="w-100" type="text" name="phone" id="phone" value="{{$user->phone}}">
                                </div>
                            </div>
                        </div>

                        <div class="default-flex-end">
                            <button class="update-user-data" type="submit">Salvar</button>
                        </div>
                    </form>

                    <h4>Endereços</h4>

                    <div class="add-new-address-button default-flex-between">
                        <div class="add-new-address-left-area default-flex">
                            <i class='bx bxs-map-pin'></i>
                            <p>Cadastrar Novo Endereço</p>
                        </div>

                        <div class="add-new-address-right-area default-flex">
                            <i class='bx bxs-plus-circle'></i>
                        </div>
                    </div>

                    <div class="user-addresses default-flex-between">
                        <div class="add-new-address-left-area default-flex">
                            <i class='bx bxs-map-pin'></i>
                            <div class="user-address-area default-flex-column">
                                <p class="user-compiled-address">R. Cândido de Souza, 952</p>
                                <p class="user-address-complement">Casa - Frente ao Deposito de Gas</p>
                            </div>
                        </div>


                        <div class="add-new-address-right-area default-flex">
                            <i class='bx bx-current-location'></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mobile-profile-my-orders-tab" style="display: {{$myOrdersDisplay}};">
                <div class="mobile-cart-header default-flex-between">
                    <a class="default-flex" wire:click="showMyOrdersTab()">
                        <i class='bx bx-chevron-left'></i>
                    </a>

                    <h3>{{$user->name}}</h3>
                </div>
            </div>

            <div class="mobile-profile-my-favorites-tab" style="display: {{$myFavoritesDisplay}};">
                <div class="mobile-cart-header default-flex-between">
                    <a class="default-flex" wire:click="showMyFavoritesTab()">
                        <i class='bx bx-chevron-left'></i>
                    </a>

                    <h3>{{$user->name}}</h3>
                </div>
            </div>
        @else
            <h4>É preciso estar logado para ver seus Perfil</h4>
        @endif
    </div>
</div>
