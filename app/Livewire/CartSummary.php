<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Http\Handlers\CartHandler;
use Illuminate\Support\Facades\Route;


class CartSummary extends Component
{

    public $cartSubtotal;
    public $cartTotal;
    public $display;

    #[On('updateCart')]
    #[On('removeFromCart')]
    public function render()
    {
        if(Route::currentRouteName() == 'cart') {
            $this->display = 'none';
        }
        $this->cartSubtotal = \App\Http\Handlers\calculateSubtotal();
        $this->cartTotal = \App\Http\Handlers\calculateTotal();

        return view('livewire.cart-summary', [
            'cartSubtotal' => $this->cartSubtotal,
            'cartTotal' => $this->cartTotal,
        ]);
    }

    public function removeFromCart($productId) {
        $this->dispatch('removeFromCart', $productId);
    }
}
