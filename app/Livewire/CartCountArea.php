<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class CartCountArea extends Component
{
    public $cartCount;


    public function render()
    {
        return view('livewire.cart-count-area');
    }

    #[On('updateCart')]
    public function updateCart($cartCount) {
        $this->cartCount = $cartCount;
    }
}
