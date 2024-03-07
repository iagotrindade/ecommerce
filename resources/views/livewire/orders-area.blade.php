<div>
    <main class="dashboard-main-area">
        <div class="order-filter-area default-flex-start">
            <div class="status-filter default-flex">
                <p class="status-filter-item @if($filter == "Delivery")
                    status-filter-item-active
                @endif" id="status-filter-item" wire:click="filterOrders(event.target.innerText)">Delivery</p>

                <p class="status-filter-item @if($filter == "Mesa")
                    status-filter-item-active
                @endif" id="status-filter-item" wire:click="filterOrders(event.target.innerText)">Mesa</p>

                <p class="status-filter-item @if($filter == "Cancelados")
                    status-filter-item-active
                @endif" id="status-filter-item" wire:click="filterOrders(event.target.innerText)">Cancelados</p>

                <p class="status-filter-item @if($filter == "Pendentes")
                    status-filter-item-active
                @endif" id="status-filter-item" wire:click="filterOrders(event.target.innerText)">Pendentes</p>
            </div>
        </div>

        <div class="orders-label default-flex-end">
            <div class="label-item default-flex">
                <div class="label-circle-red"></div>
                <p class="label-text">
                    Pedido Cancelado
                </p>
            </div>

            <div class="label-item default-flex">
                <div class="label-circle-yellow"></div>
                <p class="label-text">
                    Pedido Pendente
                </p>
            </div>

            <div class="label-item default-flex">
                <div class="label-circle-green"></div>
                <p class="label-text">
                    Pedido Aceito
                </p>
            </div>
        </div>

        <div class="orders-area default-flex-between">
            @foreach ($orders as $order)
                <a href="{{route('order', $order->id)}}" class="order-item order-item default-flex-column-between" style="border-left: 25px solid {{$order['status_color']}};">
                    <div class="order-top-info default-flex-between">
                        <p>{{$order->code}}</p>

                        <p>{{$order->order_date}}</p>
                    </div>

                    <div class="client-name-info default-flex-between">
                        <h3>{{$order->client->name}}</h3>
                    </div>

                    <div class="purchased-products-items">
                        @foreach ($order->purchasedProducts as $purchasedItem)
                            <p>x{{$purchasedItem->quantity}} {{$purchasedItem->product->name}}</p>
                        @endforeach
                    </div>

                    <div class="order-total-amount-area default-flex-between">
                        <p>Total</p>

                        <h3>R$ {{$order->totalAmount}}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </main>
</div>
