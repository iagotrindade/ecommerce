<x-adm_layout title="Pedidos" userName="{{$authUser->name}}" userImage="{{$authUser->image}}" activeMenu="orders">
    <div class="order-area">
        <div class="back-button-area">
            <a href="{{route('orders')}}">
                <i class='bx bxs-chevron-left'></i>
            </a>
        </div>

         <div class="order-number">
            <h2>{{$order->code}}</h2>
        </div>

        <div class="order-status-area default-flex">
            <p class="green-status">Ativado</p>
            <p class="red-status">Desativado</p>
        </div>

        <div class="order-date-info">
            {{$order->order_date}}
        </div>

        <div class="refund-button-area">
            <x-default_primary_button tag="a" text="Reembolso" type=""></x-default_primary_button>
        </div>

        <div class="order-top-info">
            <div class="order-main-info-area">
                <div class="order-main-info-item">
                    <div class="product-item-area">
                        <div class="stock-info-area">
                            <h4>Estoque</h4>
                            <p>19 Produtos</p>

                            <div class="product-img-area default-flex-start">
                                <img src="assets/images/products_images/camisa.png" alt="Imagem do Produto">

                                <div class="product-info-area default-flex-column">
                                    <a href="">Blusa Preta Feminina</a>

                                    <p>Código XX0000</p>
                                </div>

                                <div class="product-info-right default-flex-end">
                                    <p class="product-price">39,90</p>
                                    <p>79,90</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons-area default-flex-end">
                        <x-default_secondary_button id="" text="Sem Estoque"></x-default_secondary_button>
                        <x-default_primary_button tag="a" text="Processar Pedido" type=""></x-default_primary_button>
                    </div>
                </div>

                <div class="payment-info-area">
                    <div class="default-flex-between">
                        <p class="payment-info-bold">Subtotal</p>
                        <p class="payment-info-bold">2 Itens</p>
                        <p class="payment-info-normal default-flex-end">R$ 79,90</p>
                    </div>

                    <div class="default-flex-between">
                        <p class="payment-info-bold">Frete</p>
                        <p class="payment-info-bold" >Frete Grátis (5.0Kg)</p>
                        <p class="payment-info-normal default-flex-end">R$ 00,00</p>
                    </div>

                    <div class="default-flex-between">
                        <p class="payment-info-bold">Total</p>
                        <p class="payment-info-bold default-flex-end">R$ 79,90</p>
                    </div>

                    <div class="paid-by-client-area default-flex-between">
                        <p class="payment-info-normal">Pago pelo Cliente</p>
                        <p class="payment-info-normal default-flex-end">R$ 79,90</p>
                    </div>

                    <div class="action-buttons-area default-flex-end">
                        <x-default_secondary_button id="" text="Enviar Fatura"></x-default_secondary_button>
                        <x-default_primary_button tag="a" text="Confirmar Pagamento" type=""></x-default_primary_button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-adm_layout>

