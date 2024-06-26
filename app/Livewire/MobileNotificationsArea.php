<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Handlers\DateHandler;


class MobileNotificationsArea extends Component
{
    public $user;
    public $mobileDisplay = "none";
    public $mobileNews = "none";
    public $mobileNotifications = "block";

    public function render()
    {
        $date = \App\Http\Handlers\DateHandler();
        return view('livewire.mobile-notifications-area', [
            "date" => $date
        ]);
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    #[On('openMobileNotifications')]
    public function showMobileNotifications() {
        if($this->mobileDisplay == "none") {
            $this->mobileDisplay = "block";

            if(Auth::check()) {
                foreach ($this->user->unreadNotifications as $notification) {
                    $notification->markAsRead();
                }
            }
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
