<div class="site-main-area">
    @if (session('cart') || $stageFiveDisplay == 'flex')
        <section class="cart-stages-area default-flex">
            <div class="stage-item default-flex">
                <div class="stage-content default-flex-column @if ($stageOneDisplay == 'flex') stage-active @endif">
                    <p class="stage-number default-flex">1</p>

                    <p class="stage-text @if ($stageOneDisplay == 'flex') stage-number-active @endif">Carrinho</p>
                </div>
                <div class="stage-line"></div>
            </div>

            <div class="stage-item default-flex">
                <div class="stage-content default-flex-column @if ($stageTwoDisplay == 'block') stage-active @endif">
                    <p class="stage-number default-flex">2</p>

                    <p class="stage-text @if ($stageTwoDisplay == 'block') stage-number-active @endif">Entrega</p>
                </div>

                <div class="stage-line"></div>
            </div>

            <div class="stage-item default-flex">
                <div class="stage-content default-flex-column  @if ($stageThreeDisplay == 'flex' || $stageFourDisplay == 'flex' || $stageFiveDisplay == 'flex') stage-active @endif">
                    <p class="stage-number default-flex">3</p>

                    <p class="stage-text @if ($stageThreeDisplay == 'flex' || $stageFourDisplay == 'flex' || $stageFiveDisplay == 'flex') stage-number-active @endif">Pagamento</p>
                </div>
            </div>
        </section>

        <main>
            @if ($stageOneDisplay == 'flex')
                <div class="cart-area default-flex-between" style="display: {{ $stageOneDisplay }}">
                    <div class="cart-area-left">
                        @foreach (session('cart') as $product)
                            <div class="cart-product-item">
                                <div class="cart-product-item-top">
                                    <div class="default-flex-between">
                                        <h3>{{ $product['product']['name'] }}</h3>

                                        <h3>R$ {{ $product['product']['price'] }}</h3>
                                    </div>

                                    <div class="default-flex-between">
                                        <p class="cart-product-description">{{ $product['product']['description'] }}
                                        </p>

                                        <div class="cart-item-quantity default-flex-between">
                                            <p class="cart-quantity-action-button" id="minusButton"
                                                data-sku='{{ $product['product_sku'] }}' data-action='-'>-</p>
                                            <p>{{ $product['quantity'] }}</p>
                                            <p class="cart-quantity-action-button"
                                                data-sku='{{ $product['product_sku'] }}' data-action='+'>+</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="cart-product-item-bottom">
                                    <div class="addons-item-area">
                                        <h4>Acréscimos</h4>

                                        <div class="default-flex-column">
                                            @foreach ($product['addons'] as $addon)
                                                <div class="addon-item default-flex-between">
                                                    <p class="addon-item-title">+ {{ $addon['name'] }}</p>
                                                    <div class="cart-addon-quantity default-flex-between">
                                                        <p wire:click="alterAddonQuantity({{ $product['product_sku'] }}, {{ $addon['id'] }}, '-')"
                                                            class="addon-quantity-action-button">-</p>
                                                        <p class="addon-quantity">{{ $addon['quantity'] }}</p>
                                                        <p wire:click="alterAddonQuantity({{ $product['product_sku'] }}, {{ $addon['id'] }}, '+')"
                                                            class="addon-quantity-action-button">+</p>
                                                    </div>
                                                    <p>R$ {{ $addon['price'] }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="cart-area-right">
                        <div class="cart-area-right-title default-flex">
                            <h3>Carrinho de Compras</h3>
                        </div>

                        <div class="cart-prices-info-area">
                            <div class="cart-subtotal-area default-flex-between">
                                <p>Sub Total</p>

                                <p>R$ {{ $this->calculateSubtotal() }}</p>
                            </div>

                            <div class="cart-discount-area default-flex-between">
                                <p>Desconto</p>

                                <p>R$ 0,00</p>
                            </div>

                            <div class="cart-delivery-area default-flex-between">
                                <p>Entrega</p>

                                <p>Calcular</p>
                            </div>

                            <div class="cart-total-area default-flex-between">
                                <p>Total</p>

                                <p>R$ {{ $this->calculateTotal() }}</p>
                            </div>
                        </div>

                        <div class="cart-buttons-area default-flex-column">
                            <a class="continue-shopping-button default-flex" href="{{ route('home') }}">Seguir
                                Comprando</a>

                            <p class="next-stage-button default-flex" wire:click="changeCartStage(2)">CONTINUAR</p>
                        </div>
                    </div>
                </div>
            @endif
        </main>
    @else
        <div class="empty-cart-area default-flex-between">
            <p>Poxa, parece que seu carrinho ainda está vazio :(</p>

            <a class="go-shopping-button default-flex" href="{{ route('home') }}">Comprar Agora</a>
        </div>
    @endif

    @if ($stageTwoDisplay == 'block')
        <div class="cart-shipping-area" style="display: {{ $stageTwoDisplay }}">
            <div class="cart-shipping-title default-flex-start">
                <i class='bx bxs-map'></i>
                <h3>Informar Endereço</h3>
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
                        <input class="w-100" type="text" name="name" id="name" wire:model="name">
                    </div>
                </div>

                <div class="cart-shipping-area-input-group">
                    <div class="shipping-input-item default-flex-column w-100">
                        <label for="client_name">Nome</label>
                        <input class="w-100" type="text" name="client_name" id="client_name"
                            wire:model="clientName">
                    </div>
                </div>

                <div class="cart-shipping-area-input-group">
                    <div class="shipping-input-item default-flex-column w-100">
                        <label for="cpf">CPF</label>
                        <input class="w-100" type="text" name="cpf" id="cpf" wire:model="clientCpf">
                    </div>
                </div>

                <div class="cart-shipping-area-input-group default-flex-around">
                    <div class="shipping-input-item default-flex-column w-100">
                        <label for="street">Rua</label>
                        <div class="default-flex-start w-95">
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

                <div class="cart-shipping-area-input-group default-flex-around">
                    <div class="shipping-input-item default-flex-column w-100">
                        <label for="email">Email</label>
                        <input class="w-95" type="email" name="email" id="email" wire:model="email">
                    </div>

                    <div class="shipping-input-item default-flex-column w-100">
                        <label for="whatsapp">Whatsapp</label>
                        <input class="w-100" type="text" name="whatsapp" id="whatsapp" wire:model="whatsapp">
                    </div>
                </div>

                <div class="default-flex-end">
                    <p class="next-stage-button default-flex" wire:click="changeCartStage(3)">CONTINUAR</p>
                </div>
            </div>
        </div>
    @endif

    @if ($stageThreeDisplay == 'flex')
        <div class="payment-area default-flex-between" style="display: {{ $stageThreeDisplay }}">
            <div class="payment-area-left w-60">
                <div class="payment-area-left-holder">
                    <div class="payment-area-left-top default-flex-start">
                        <i class='bx bxs-map'></i>
                        <h2>Selecione o Endereço</h2>
                    </div>

                    <div class="select-address-area default-flex-between">
                        <div class="address-info default-flex-column">
                            <p>{{ session('shipping')['name'] }}</p>
                            <p>
                                {{ session('shipping')['compiled_address'] }}
                            </p>
                        </div>

                        <div class="address-actions default-flex">
                            <p class="address-actions-edit-button" wire:click="changeCartStage(2)">Editar</p>

                            <p class="address-actions-new-button" wire:click="changeCartStage(2)">Novo Endereço</p>
                        </div>
                    </div>
                </div>


                <div class="cart-products-area">
                    @foreach (session('cart') as $product)
                        <div class="cart-products-area-item default-flex-column">
                            <h2>{{ $product['product']['name'] }}</h2>

                            <div class="default-flex-between w-100">
                                <p class="cart-products-area-item-description w-50">
                                    {{ $product['product']['description'] }}</p>
                                <p class="cart-products-area-item-value">R$ {{ $product['product']['price'] }}</p>
                            </div>

                            <div class="cart-product-item-bottom w-100">
                                <div class="addons-item-area">
                                    <h4>Acréscimos</h4>

                                    <div class="default-flex-column">
                                        @foreach ($product['addons'] as $addon)
                                            <div class="addon-item default-flex-between">
                                                <p class="addon-item-title">+ {{ $addon['name'] }}</p>
                                                <p>R$ {{ $addon['price'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="shipping-summary-area">
                    <div class="shipping-summary-area-top default-flex-start">
                        <img src="{{ url('assets/images/site-icons/motocycle_icon.png') }}" alt="Entrega">
                        <h2>Entrega</h2>
                    </div>

                    <div class="shipping-summary-area-info">
                        <div class="address-summary default-flex-between">
                            <div>
                                <p class="address-summary-title">Endereço Principal</p>
                                <p class="address-summary-info w-50">
                                    {{ session('shipping')['compiled_address'] }}
                                </p>
                            </div>

                            <p class="address-actions-edit-button default-flex-column-end"
                                wire:click="changeCartStage(2)">ALTERAR</p>
                        </div>

                        <div class="select-delivery-button default-flex-between">
                            <div class="default-flex">
                                <div class="switch-container" style="margin: 0; width: 35px;"
                                    wire:click="changeOrderType('delivery')">
                                    <input id="edit-switch-shadow-delivery" class="switch switch--shadow"
                                        type="checkbox" name="order_type" wire:model="deliveryOrder"
                                        value="delivery">
                                    <label for="edit-switch-shadow-delivery"></label>
                                </div>
                                <p class="delivery-choice @if ($deliveryOrder == true) delivery-active @endif">
                                    Delivery</p>
                            </div>


                            <p class="delivery-choice @if ($deliveryOrder == true) delivery-active @endif">R$
                                {{ session('shipping')['shipping_value'] }}</p>
                        </div>

                        <div class="select-nodelivery-button default-flex-between">
                            <div class="default-flex">
                                <div class="switch-container" style="margin: 0; width: 35px;"
                                    wire:click="changeOrderType('table')">
                                    <input id="edit-switch-shadow-nodelivery" class="switch switch--shadow"
                                        type="checkbox" name="order_type" wire:model="tableOrder" value="table">
                                    <label for="edit-switch-shadow-nodelivery"></label>
                                </div>
                                <p class="nodelivery-choice @if ($tableOrder == true) delivery-active @endif">
                                    Retirar no Local</p>
                            </div>

                            <p class="nodelivery-choice @if ($tableOrder == true) delivery-active @endif">
                                Grátis</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-summary-area-right w-40">
                <div class="cart-summary-title default-flex W-100">
                    <h3>Resumo</h3>
                </div>

                <div class="cart-summary-prices-info-area">
                    <div class="cart-summary-subtotal-area default-flex-between">
                        <p>Valor dos Produtos</p>

                        <p>R$ {{ $this->calculateSubtotal() }}</p>
                    </div>

                    <div class="cart-summary-shipping-area default-flex-between">
                        <p>Entrega</p>

                        <p>R$ {{ session('shipping')['shipping_value'] }}</p>
                    </div>

                    <div class="cart-summary-total-area default-flex-between w-95">
                        <p>Total</p>

                        <p>R$ {{ $this->calculateTotal() }}</p>
                    </div>

                    <div class="select-payment-area">
                        <h4>Selecione a Forma de Pagamento</h4>

                        <div class="payment-type-list">
                            <div class="pix-payment default-flex-start" wire:click="changePaymentType('pix')">
                                <img src="{{ url('assets/images/site-icons/pix_icon.png') }}" alt="PIX">
                                <p @if ($paymentType == 'pix') class="payment-active" @endif>Pix</p>
                                @if ($paymentType == 'pix')
                                    <div class="w-100 default-flex-end">
                                        <i class='bx bx-check'></i>
                                    </div>
                                @endif
                            </div>

                            <div class="default-flex-between">
                                <div class="money-payment default-flex-start" wire:click="changePaymentType('money')">
                                    <img src="{{ url('assets/images/site-icons/money_icon.png') }}" alt="Dinheiro">
                                    <p @if ($paymentType == 'money') class="payment-active" @endif>Dinheiro</p>
                                    @if ($paymentType == 'money')
                                        <div class="w-100 default-flex-end">
                                            <i class='bx bx-check'></i>
                                        </div>
                                    @endif
                                </div>

                                @if ($paymentType == 'money')
                                    <div class="money-input-item default-flex-column">
                                        <label for="money">Troco</label>
                                        <input class="w-95" type="text" name="money" id="money"
                                            wire:model="valueBack" wire:change='formatCurrency()'>
                                    </div>
                                @endif
                            </div>

                            <div class="card-payment default-flex-start" wire:click="changePaymentType('card')">
                                <img src="{{ url('assets/images/site-icons/card_icon.png') }}" alt="Cartão">
                                <p @if ($paymentType == 'card') class="payment-active" @endif>Cartão</p>
                                @if ($paymentType == 'card')
                                    <div class="w-100 default-flex-end">
                                        <i class='bx bx-check'></i>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="finalize-purchase default-flex" wire:click="finalizePurchase()">
                            <p>FINALIZAR</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (!empty($paymentAssas))
        <div class="pay-qrcode-area" style="display: {{ $stageFourDisplay }}">
            <div class="default-flex-column w-100">
                <div class="pay-qrcode-top-area default-flex-start w-100">
                    <i class='bx bx-left-arrow-alt' wire:click="changeCartStage(3)"></i>

                    <div class="pay-qrcode-top-title default-flex">
                        <img src="{{ url('assets/images/site-icons/pix_blackwhite_icon.png') }}" alt="Pix">

                        <h3>Pagar com PIX</h3>
                    </div>
                </div>

                <div class="pix-value-area default-flex-between w-60">
                    <h3>Valor do Pix</h3>

                    <h3>R$ {{ $this->calculateTotal() }}</h3>
                </div>

                <div class="pix-qrcode-area default-flex-between">
                    <div class="pix-instructions-area default-flex-column">
                        <h4>Instruções</h4>

                        <p>1. Copie o código PIX</p>

                        <p>2. Abra o aplicativo do seu banco</p>

                        <p>3. Entre na área Pix Copia e Cola</p>

                        <p>4. Cole o código e finalize a transação</p>
                    </div>

                    <div class="pix-qrcode">
                        <img src="data:image/png;base64, {{ $pixQrcode->encodedImage }}" alt="QRCode">
                    </div>
                </div>

                <div class="default-flex">
                    <div class="pix-code-area">
                        <p id="pixCode">{{ $pixQrcode->payload }}</p>
                    </div>

                    <div class="copy-pix-code-button" id="copyCode">
                        <p>Copiar</p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var copyCode = document.getElementById('copyCode');
                var pixCode = document.getElementById('pixCode');

                copyCode.addEventListener('click', function() {
                    // Seleciona o texto dentro do elemento <p>
                    var range = document.createRange();
                    range.selectNode(pixCode);
                    window.getSelection().removeAllRanges(); // Limpa a seleção anterior
                    window.getSelection().addRange(range);

                    // Tenta copiar o texto selecionado
                    try {
                        document.execCommand('copy');
                        alert('Texto copiado para a área de transferência.');
                    } catch (err) {
                        console.log('Erro ao copiar: ', err);
                        alert('Não foi possível copiar o texto.');
                    }

                    // Limpa a seleção
                    window.getSelection().removeAllRanges();
                });
            });
        </script>

        @script
            <script>
                setInterval(() => {
                    $wire.$refresh()
                }, 3000)
            </script>
        @endscript
    @endif

    @if ($stageFiveDisplay == 'flex')
        <div class="final-payment-warning-area default-flex-column" style="display: {{ $stageFiveDisplay }}">
            <div class="final-payment-warning-back-button default-flex-start w-100">
                <i class='bx bx-left-arrow-alt' wire:click="changeCartStage(1)"></i>
            </div>

            <div class="warning-info-area default-flex-column">
                <div class="warning-info-image-area default-flex">
                    <i class='bx bx-check'></i>
                </div>

                <h3>Pagamento realizado com Sucesso!</h3>

                <a href="">Seguir para Seus Pedidos -></a>
            </div>
        </div>
    @endif

    @script
        <script>
            document.querySelector('#cart-summary-menu').style.display = 'none';
            document.querySelectorAll('.cart-quantity-action-button').forEach(element => {
                element.addEventListener('click', function() {
                    if (element.dataset['action'] == '-') {
                        let targetAction = element.nextElementSibling.innerText;

                        if (parseInt(targetAction) <= 1) {
                            setTimeout(() => {
                                if (confirm('Deseja remover o produto do seu carrinho?')) {
                                    $wire.dispatch('alterProductQuantity', {
                                        action: element.dataset['action'],
                                        productSku: element.dataset['sku']
                                    });
                                }
                            }, 500);
                        } else {
                            $wire.dispatch('alterProductQuantity', {
                                action: element.dataset['action'],
                                productSku: element.dataset['sku']
                            });
                        }
                    } else {
                        let targetAction = element.previousElementSibling.innerText;

                        $wire.dispatch('alterProductQuantity', {
                            action: element.dataset['action'],
                            productSku: element.dataset['sku']
                        });
                    }
                })
            });
        </script>
    @endscript
</div>
