<div>
    <main class="dashboard-main-area">
        <div class="order-filter-area default-flex">
            <div class="status-filter default-flex">
                <p class="status-filter-item @if($filter == "Todos")
                    status-filter-item-active
                @endif" id="status-filter-item" wire:click="filterOrders(event.target.innerText)">Todos</p>

                <p class="status-filter-item @if($filter == "Não Processados")
                    status-filter-item-active
                @endif" id="status-filter-item" wire:click="filterOrders(event.target.innerText)">Não Processados</p>

                <p class="status-filter-item @if($filter == "Processados")
                    status-filter-item-active
                @endif" id="status-filter-item" wire:click="filterOrders(event.target.innerText)">Processados</p>

                <p class="status-filter-item @if($filter == "Pendentes")
                    status-filter-item-active
                @endif" id="status-filter-item" wire:click="filterOrders(event.target.innerText)">Pendentes</p>
                <p class="status-filter-item @if($filter == "Cancelados")
                    status-filter-item-active
                @endif" id="status-filter-item" wire:click="filterOrders(event.target.innerText)">Cancelados</p>
            </div>

            <div class="split-bar"></div>

            <div class="location-filter default-flex">
                <i class='bx bxs-map'></i>

                <select type="select" name="location-filter-select" id="city-filter-item" wire:model="filteredCity" wire:change="filterOrdersByCity">
                    <option value="default" selected>Todos os Locais</option>
                        @foreach ($ordersCities as $orderCity)
                            <option value="{{$orderCity->order_city}}">{{$orderCity->order_city}}</option>
                        @endforeach
                </select>
            </div>
        </div>

        <div class="orders-table-area default-flex">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th scope="col">Pedido</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Data</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Status do Pagamento</th>
                        <th scope="col">Status do Processamento</th>
                    </tr>
                </thead>

                <tbody class = "orders-table-body">
                    @foreach ($orders as $order)
                        <tr id = "order-item" data-city="{{$order['order_city']}}">
                            <th scope="row">
                                <a href="{{route('order', ['id' => $order['id']])}}" class="order-number">{{$order['code']}}</a>
                            </th>

                            <td>
                                {{$order['client_name']}}
                            </td>

                            <td>
                                {{$order['order_date']}}
                            </td>

                            <td>
                                R$  {{$order['total_amount']}}
                            </td>

                            <td id="payment-status">
                                <p class="{{$order['payment_color']}}">{{$order['payment_status']}}</p>
                            </td>

                            <td id="processing-status">
                                <p class="{{$order['processing_color']}}">{{$order['processing_status']}}</p></p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
