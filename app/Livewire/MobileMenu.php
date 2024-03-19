<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class MobileMenu extends Component
{
    public $cartCount;

    public function render()
    {
        return view('livewire.mobile-menu');
    }

    #[On('updateCart')]
    public function updateCart($cartCount) {
        $this->cartCount = $cartCount;
    }

    public function openMobileSearch() {
        $this->dispatch('openMobileSearch');
    }

    public function openMobileNotifications() {
        $this->dispatch('openMobileNotifications');
    }

    public function openProfileTab() {
        $this->dispatch('openProfileTab');
    }
}
