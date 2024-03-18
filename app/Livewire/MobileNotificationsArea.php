<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;


class MobileNotificationsArea extends Component
{
    public $user;
    public $mobileDisplay = "none";
    public $mobileNews = "none";
    public $mobileNotifications = "block";

    public function render()
    {
        return view('livewire.mobile-notifications-area');
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    #[On('openMobileNotifications')]
    public function showMobileNotifications() {
        if($this->mobileDisplay == "none") {
            $this->mobileDisplay = "block";
        }

        else {
            $this->mobileDisplay = "none";
        }
    }

    public function changeNotificationsTab($type) {
        if($type == "notifications") {
            $this->mobileNotifications = "block";
            $this->mobileNews = "none";
        }

        else {
            $this->mobileNews = "block";
            $this->mobileNotifications = "none";
        }
    }
}
