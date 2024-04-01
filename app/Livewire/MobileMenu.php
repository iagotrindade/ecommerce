<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class MobileMenu extends Component
{
    public $user;
    public $cartCount;
    public $newNotificationCount;

    public function render()
    {
        if(Auth::check()) {
            $this->user = Auth::user();
            $this->newNotificationCount = count($this->user->unreadNotifications);
        }

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
