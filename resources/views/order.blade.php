<x-adm_layout title="Pedidos" activeMenu="orders" :user="$user">
    <div class="order-area">
        <div class="order-top-info-area default-flex-column">
            <div class="order-first-info-area default-flex-between">
                <h2>{{$order->client->name}}</h2>

                <p class="order-date">Pedido feito em {{$order->order_date}}</p>

                <h2>{{$order->code}}</h2>
            </div>

            <div class="order-second-info-area default-flex-between">
                <div class="order-info-button-item default-flex">
                    Entrega Prevista: 19:33
                </div>

                <div class="order-info-button-item default-flex">
                    <a href="tel:{{$order->client->phone}}">
                        {{$order->client->phone}}
                    </a>
                </div>

                <div class="order-info-button-item default-flex">
                    @if ($order->client->is_new == 1)
                        Cliente Novo!
                    @else
                        Cliente Veterano!
                    @endif
                </div>
            </div>
        </div>

        <div class="order-status default-flex" style="background-color: {{$order->status_color}};">
            <p>{{$order->status}}</p>
        </div>

        <div class="time-to-accept-area default-flex-between">
            <p>
                @if ($order->accept_time <= 10)
                    {{10 - $order->accept_time}} minutos para aceitar o pedido!
                @else

                    O tempo para aceitar o pedido expirou!
                @endif
            </p>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach

            @else
                <a href="{{route('refund', $order->id)}}" class="refund-order default-flex">
                    <p>Reembolsar</p>

                    <img src="{{url('assets/images/panel-icons/round_arrow.png')}}" alt="Reembolsar">
                </a>
            @endif
        </div>

        <div class="order-product-items-area">

            @foreach ($order->purchasedProducts as $purchasedProduct)
                <div class="order-product-item default-flex-column">
                    <h3>{{$purchasedProduct->product->name}}</h3>

                    <div class="order-product-addons default-flex-between">
                        <p class="order-addons">
                            {{$purchasedProduct->product->description}}
                        </p>

                        <p>R$ {{$purchasedProduct->product->price}}</p>
                    </div>

                    <div class="order-additional-addons default-flex-column">
                        <h3>*Adicionais</h3>
                        <!--PROBLEMA ESTÁ AQUI, VERIFICAR E CORRIGIR-->
                        @foreach ($purchasedProduct->productAddons as $addon)
                            <p class="order-addons">+ {{$addon->quantity.' '.$addon->addon->name}}</p>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="order-product-item default-flex-between">
                <h3>Entrega</h3>
                <h3>R$ {{$order->shipping_amount}}</h3>
            </div>

            <div class="order-product-item default-flex-between">
                <h3>Total</h3>
                <h3>R$ {{$order->totalAmount}}</h3>
            </div>

            @if ($order->payment_type != 'PIX')
                <div class="order-product-item default-flex-between">
                    <div class="payment-obs-area">
                        <h4>Cobrar do cliente na hora da entrega - Dinheiro</h4>
                        <p>O entregador deverá cobrar este valor na hora da entrega</p>
                    </div>

                    <h3>R$ {{$order->totalAmount}}</h3>
                </div>
            @endif
        </div>

        <div class="observation-area">
            <h4>Observações</h4>

            <p>
                @if (!empty($order->obs))
                    {{$order->obs}}
                @else
                    Não á observações do cliente.
                @endif

            </p>
        </div>

        <div class="client-info-area">
            <div class="basic-info">
                <h4>Cliente</h4>
                <p>{{$order->client->name}}</p>
                <a href="{{route('users', $order->client->id)}}">Ver Perfil</a>
            </div>

            <div class="contact-info">
                <h4>Informações de Contato</h4>
                <a href="mailto:{{$order->client->email}}">{{$order->client->email}}</a>
                <p>{{$order->client->phone}}</p>
            </div>

            <div class="shipping-info">
                <h4>Endereço de Entrega</h4>
                <p>{{$order->client->name}}</p>
                <p>{{$order->client->address->address}}</p>
                <p>Cep: {{$order->client->address->cep}}</p>
                <p>Casa</p>
                <p>Referencia: {{$order->client->address->complement}}</p>

                <a href="https://www.google.com/maps?q={{$order->client->address->address}}" target="_blank">Ver no Mapa</a>
            </div>


            <div class="shipping-info">
                <h4>Endereço de Faturamento</h4>
                <p>Usar Endereço de entrega</p>
            </div>
        </div>

        <div class="order-actions-area default-flex-between">
            <a href="" class="cancel-order-button">Cancelar</a>
            <a href="" class="confirm-order-button default-flex">Confirmar</a>
        </div>
    </div>
</x-adm_layout>

