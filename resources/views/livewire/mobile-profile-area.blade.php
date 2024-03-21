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
                    <form wire:submit="updateUserData">
                        <h4>Informações Pessoais</h4>

                        @if ($profileWarning !== "")
                            <p>{{$profileWarning}}</p>
                        @endif

                        <div class="mobile-user-data">
                            <div class="cart-shipping-area-input-group default-flex-around">
                                <div class="shipping-input-item default-flex-column w-100">
                                    <label for="name">Nome</label>
                                    <input class="w-100" type="text" name="name" id="name" wire:model="userName" required>
                                </div>

                                <div class="shipping-input-item default-flex-column w-100">
                                    <label for="username">Usuário</label>
                                    <input class="w-100" type="text" name="username" id="username" wire:model="userUsername" required>
                                </div>
                            </div>
                        </div>

                        <h4>Dados de Contato</h4>

                        <div class="mobile-user-data">
                            <div class="cart-shipping-area-input-group default-flex-around">
                                <div class="shipping-input-item default-flex-column w-100">
                                    <label for="email">E-Mail</label>
                                    <input class="w-100" type="email" name="email" id="email" wire:model="userEmail" required>
                                </div>

                                <div class="shipping-input-item default-flex-column w-100">
                                    <label for="phone">Whatsapp</label>
                                    <input class="w-100" type="text" name="phone" id="phone" wire:model="userPhone" required>
                                </div>

                                <div class="shipping-input-item default-flex-column w-100">
                                    <label for="password">Senha</label>
                                    <input class="w-100" type="password" name="password" id="password" wire:model="userPassword" required>
                                </div>

                                <div class="shipping-input-item default-flex-column w-100">
                                    <label for="new_password">Nova Senha</label>
                                    <input class="w-100" type="password" name="new_password" id="new_password" wire:model="userNewPassword">
                                </div>
                            </div>
                        </div>

                        <div class="default-flex-end">
                            <button class="update-user-data" type="submit" wire:click="updateUserData()">Salvar</button>
                        </div>
                    </form>

                    <h4>Endereços</h4>

                    <div class="add-new-address-button default-flex-between" wire:click="showAddNewAddress()">
                        <div class="add-new-address-left-area default-flex">
                            <i class='bx bxs-map-pin'></i>
                            <p>Cadastrar Novo Endereço</p>
                        </div>

                        <div class="add-new-address-right-area default-flex">
                            <i class='bx bxs-plus-circle'></i>
                        </div>
                    </div>

                    @foreach ($user->address as $address)
                        <div class="user-addresses default-flex-between">
                            <div class="add-new-address-left-area default-flex">
                                <i class='bx bxs-map-pin'></i>
                                <div class="user-address-area default-flex-column">
                                    <p class="user-compiled-address">{{$address->address}}</p>
                                    <p class="user-address-complement">{{$address->complement}}</p>
                                </div>
                            </div>


                            <div class="add-new-address-right-area default-flex" wire:confirm="Deseja realmente excluir este endereço?" wire:click="deleteAddress({{$address->id}})">
                                <i class='bx bxs-trash-alt'></i>
                            </div>
                        </div>
                    @endforeach    
                </div>
            </div>

            <div class="mobile-profile-add-new-address-form" style="display: {{$newAddressDisplay}}">
                <div class="mobile-cart-header default-flex-between">
                    <a class="default-flex" wire:click="showAddNewAddress()">
                        <i class='bx bx-chevron-left'></i>
                    </a>

                    <h3>Adicionar Endereço</h3>
                </div>

                <p class="cart-shipping-title-inputs-warning">{{ $inputsError }}</p>

                <div class="cart-shipping-area-inputs">
                    <div class="cart-shipping-area-input-group default-flex-around">
                        <div class="shipping-input-item default-flex-column w-100">
                            <label for="cep">CEP</label>
                            <input class="w-95" type="text" name="cep" id="cep" oninput="formatCEP(this)"
                                wire:model="zipcode" wire:keyup="findAdress()"
                                @if ($cepError !== '') style="border: 1px solid red; color: red;" @else style="border: 1px solid --var(primary-color); color: --var(primary-color);" @endif>
                        </div>
    
                        <div class="shipping-input-item default-flex-column w-100">
                            <label for="name">Identificação</label>
                            <input class="w-100" type="text" name="name" id="name" wire:model="name" placeholder="Exemplo: Minha Casa">
                        </div>
                    </div>
    
                    <div class="cart-shipping-area-input-group default-flex-around">
                        <div class="shipping-input-item default-flex-column w-100">
                            <label for="street">Rua</label>
                            <div class="street-readonly-input default-flex-start w-95">
                                <input class="w-100 input-blocked" type="text" name="street" id="street" readonly
                                    wire:model="street">
                                <i class='bx bxs-lock'></i>
                            </div>
                        </div>
    
                        <div class="shipping-input-item default-flex-column w-20">
                            <label for="number">Número</label>
                            <input class="w-100" type="text" name="number" id="number" wire:model="number">
                        </div>
                    </div>
    
                    <div class="cart-shipping-area-input-group">
                        <div class="shipping-input-item default-flex-column w-100">
                            <label for="complement">Complemento</label>
                            <input class="w-100" type="text" name="complement" id="complement"
                                wire:model="complement">
                        </div>
                    </div>
    
                    <div class="cart-shipping-area-input-group">
                        <div class="shipping-input-item default-flex-column w-100">
                            <label for="district">Bairro</label>
                            <div class="default-flex-start w-100">
                                <input class="w-100 input-blocked" type="text" name="district" id="district"
                                    readonly wire:model="district">
                                <i class='bx bxs-lock'></i>
                            </div>
                        </div>
                    </div>
    
                    <div class="cart-shipping-area-input-group">
                        <div class="shipping-input-item default-flex-column w-100">
                            <label for="reference">Referência</label>
                            <input class="w-100" type="text" name="reference" id="reference"
                                wire:model="reference">
                        </div>
                    </div>

                    <div class="default-flex-end">
                        <p class="next-stage-button default-flex" wire:click="addNewAddress()">ADICIONAR</p>
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

                <div class="my-orders-mobile-area">
                    <h4>Histórico</h4>

                    <div class="my-order-list default-flex-column">
                        @if (!empty($userOrders))
                            @foreach ($userOrders as $order)
                                <div class="my-order-item">
                                    <div class="my-order-item-top default-flex-between">
                                        <p class="my-order-number">{{$order->code}}</p>

                                        <p>{{$order->order_date}}</p>

                                        <p>R$ {{$order->total_amount}}</p>

                                        <i class='bx bx-chevron-right'></i>
                                    </div>

                                    <div class="my-order-products-area">
                                        <ol>
                                            <li>Martelo do Thor</li>
                                            <li>Martelo do Thor</li>
                                            <li>Martelo do Thor</li>
                                        </ol>
                                    </div>

                                    <div class="my-order-buy-again default-flex">
                                        <a href="">Pedir Novamente</a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Você ainda não tem nenhum pedido :(</p>
                        @endif
                            
                    </div>
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

<script>
    function formatCEP(input) {
        input.value = input.value.replace(/\D/g, '').slice(0, 8).replace(/(\d{5})(\d{0,3})/, '$1-$2');
    }
</script>
