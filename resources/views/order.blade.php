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

        <div class="order-product-item-area">
            <div class="stock-info-area default-flex-column">
                <h4>Estoque:</h4>
                <p>19 Produtos</p>
            </div>

            <div class="product-info-area default-flex-between">
                <div class="product-info-left-area default-flex">
                    <img src="assets/images/products_images/camisa.png" alt="Imagem do Produto">

                    <div class="product-info-text">
                        <a href="">Blusa Preta Feminina</a>

                        <p>Código: 0144458</p>
                    </div>
                </div>

                <div class="product-info-right-area default-flex">
                    <p class="product-info-prices">R$ 39,90 X2</p>
                    <p class="product-info-total-amount">R$ 79,90</p>
                </div>
            </div>

            <div class="order-product-actions-area default-flex-end">
                <x-default_secondary_button id="" text="Sem Estoque"></x-default_secondary_button>
                <x-default_primary_button tag="a" type="" text="Processar Pedido"></x-default_primary_button>
            </div>
        </div>

        <div class="order-products-values-area">
            <div class="subtotal-amount-area default-flex-between">
                <p>Subtotal</p>
                <p>2 Itens</p>
                <p class="default-flex-end">R$ 79,90</p>
            </div>

            <div class="shipping-amount-area default-flex-between">
                <p>Frete</p>
                <p>Frete Grátis (5.0Kg)</p>
                <p class="default-flex-end">R$ 00,00</p>
            </div>

            <div class="total-amount-area default-flex-between">
                <p>Total</p>
                <p class="default-flex-end">R$ 79,90</p>
            </div>

            <div class="payment-type-area default-flex-between">
                <p>Pago pelo Cliente</p>
                <p class="default-flex-end">R$ 79,90</p>
            </div>

            <div class="order-payment-product-actions-area default-flex-end">
                <x-default_secondary_button id="" text="Enviar Fatura"></x-default_secondary_button>
                <x-default_primary_button tag="a" type="" text="Confirmar Pagamento"></x-default_primary_button>
            </div>
        </div>

        <div class="timeline-area">
            <h3>Cronograma</h3>

            <div class="default-flex">
                <div class="timeline-item default-flex-column-start">
                    <p>E-mail de confirmação enviado</p>
                    <div class="time-line-event default-flex">
                        <div class="timeline-line-left"></div>
                        <i class='bx bxs-circle'></i>
                        <div class="timeline-line-right"></div>
                    </div>
                    <a href="">Enviar E-mail</a>
                </div>

                <div class="timeline-item default-flex-column-start">
                    <p>Pagamento feito com sucesso</p>
                    <div class="time-line-event default-flex">
                        <div class="timeline-line-left"></div>
                        <i class='bx bxs-circle'></i>
                        <div class="timeline-line-right"></div>
                    </div>
                </div>

                <div class="timeline-item default-flex-column-start">
                    <p>Pedido em processamento</p>
                    <div class="time-line-event default-flex">
                        <div class="timeline-line-left"></div>
                        <i class='bx bxs-circle'></i>
                        <div class="timeline-line-right"></div>
                    </div>
                </div>

                <div class="timeline-item default-flex-column-start">
                    <p>Pedido Processado</p>
                    <div class="time-line-event default-flex">
                        <div class="timeline-line-left"></div>
                        <i class='bx bxs-circle'></i>
                        <div class="timeline-line-right"></div>
                    </div>
                </div>

                <div class="timeline-item default-flex-column-start">
                    <p>Pedido Enviado a transportadora</p>
                    <div class="time-line-event default-flex">
                        <div class="timeline-line-left"></div>
                        <i class='bx bxs-circle'></i>
                        <div class="timeline-line-right"></div>
                    </div>
                </div>

                <div class="timeline-item default-flex-column-start">
                    <p>Pedido em rota de entrega</p>
                    <div class="time-line-event default-flex">
                        <div class="timeline-line-left"></div>
                        <i class='bx bxs-circle'></i>
                        <div class="timeline-line-right"></div>
                    </div>
                    <a href="">Verificar andamento</a>
                </div>

                <div class="timeline-item default-flex-column-start">
                    <p>Pedido entregue ao cliente</p>
                    <div class="time-line-event default-flex">
                        <div class="timeline-line-left"></div>
                        <i class='bx bxs-circle'></i>
                        <div class="timeline-line-right"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="observation-area">
            <h4>Observações</h4>
            <p>Não á observações do cliente.</p>
        </div>

        <div class="client-info-area">
            <div class="basic-info">
                <h4>Cliente</h4>
                <p>Iago Silva</p>
                <a href="">Ver Perfil</a>
            </div>
            
            <div class="contact-info">
                <h4>Informações de Contato</h4>
                <a href="">iago23st1@gmail.com</a>
                <p>51991657516  </p>
            </div>

            <div class="shipping-info">
                <h4>Endereço de Entrega</h4>
                <p>Iago Silva</p>
                <p>Rua San Felipe 66 - Stella Maris</p>
                <p>Cep: 33333-222</p>
                <p>Casa</p>
                <p>Referencia: Em frente a um campo</p>

                <a href="">Ver no Mapa</a>
            </div>
        </div>
</x-adm_layout>

