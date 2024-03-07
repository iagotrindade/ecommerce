<div class="default-flex">
    <div class="search-wrapper">
        <div class="search-input default-flex">
            <input type="text" name="search" id="search" placeholder="Pesquisar" wire:keyup="searchAll" wire:model="searchTerm" style="border-bottom-right-radius: {{$border}}; border-bottom-left-radius: {{$border}}">
        </div>

        <div class="search-container" id="notificationContainer" style="display: {{$display}}; border-top-left-radius: {{$border}}; border-bottom-right-radius: {{$border}}">
            <div class="search-list">
                <div class="search-result-item">
                    <div class="search-result-title-area default-flex-start">
                        <i class='bx bxs-category'></i>
                        <p>Pedidos</p>
                    </div>

                    @foreach ($orders as $order)
                        <div class="search-result-item-list default-flex-column">
                            <a href="{{route("order", $order->id)}}">Pedido {{$order->code}} / {{$order->client->name}}</a>
                        </div>
                    @endforeach
                </div>

                <div class="search-result-item">
                    <div class="search-result-title-area default-flex-start">
                        <i class='bx bx-package'></i>
                        <p>Produtos</p>
                    </div>

                    @foreach ($products as $product)
                        <div class="search-result-item-list default-flex-column">
                            <a href="{{route('carte', $product->id)}}">Produto {{$product->name}}</a>
                        </div>
                    @endforeach
                </div>

                <div class="search-result-item">
                    <div class="search-result-title-area default-flex-start">
                        <i class='bx bx-group'></i>
                        <p>Usuários</p>
                    </div>

                    @foreach ($users as $user)
                        <div class="search-result-item-list default-flex-column">
                            <a href="{{route('users', $user->id)}}">Usuário {{$user->name}}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
