<div>
    <div class="header-cart-icon-area" onclick="toggleMenu()">
        <div class="default-flex">
            <i class="bx bx-shopping-bag @if (session('cart')) cart-with-items @endif"></i>
            @if (session('cart'))
                <p class="cart-count-area">{{$cartCount}}</p>
            @endif

            <p>Carrinho</p>
        </div>
    </div>
</div>
