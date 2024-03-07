<div style="display: {{$display}};">
    <div id="cart-summary-menu" class="cart-summary-menu default-flex-column-between" @if (session('cart')) style="right: 0;" @endif>
        @if (session('cart'))
            <div class="cart-summary-menu-title">
                <div class="default-flex-start">
                    <p class="close-sumary-cart" onclick="toggleMenu()">X</p>
                    <h3>Carrinho</h3>
                </div>

                <div class="cart-sumary-item-area default-flex-column">


                    @foreach (session('cart') as $item)
                        <h3>{{$item['category']}}</h3>
                        <div class="cart-summary-menu-item">
                            <div class="cart-summary-menu-top default-flex-between">
                                <div class="default-flex">
                                    <p class="cart-summary-menu-quantity">{{$item['quantity']}}x</p>

                                    <h4>{{$item['product']['name']}}</h4>
                                </div>

                                <p class="default-flex-start">R$ {{$item['product']['price']}}</p>
                            </div>


                            <div class="cart-summary-menu-bottom default-flex-column">
                                <p class="cart-summary-menu-description">{{$item['product']['description']}}</p>

                                <div class="cart-summary-menu-addons default-flex-column">
                                    @foreach ($item['addons'] as $addon)
                                        <p>{{$addon['quantity'].'x '.$addon['name']}}</p>
                                    @endforeach
                                </div>

                                <div class="cart-summary-menu-actionbar default-flex">
                                    <a href="{{route('cart')}}">Editar</a>
                                    <p wire:click="removeFromCart({{$item['id']}})" wire:confirm="Tem certeza que deseja excluir o produto do seu Carrinho?">Remover</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <h3>Bebidas</h3>

                    <div class="cart-summary-subtotal-area">
                        <div class="cart-summary-subtotal-top default-flex-between">
                            <h4>Subtotal</h4>
                            <p>R$ {{$cartSubtotal}}</p>
                        </div>

                        <div class="default-flex-between">
                            <h4>Taxa de Entrega</h4>
                            <p>R$ 0,00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-summary-total-area default-flex-column">
                <div class="cart-summary-total-top default-flex-between">
                    <h3>Total</h3>
                    <p>R$ {{$cartTotal}}</p>
                </div>

                <a href="{{route('cart')}}" class="default-flex">FINALIZAR</a>
            </div>
        @else
            <h3 class="empty-cart-warning default-flex">Poxa, parece que seu carrinho ainda está vazio :(</h3>
        @endif
    </div>
</div>
