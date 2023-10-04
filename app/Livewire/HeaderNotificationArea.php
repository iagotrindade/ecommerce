<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Models\Notification;

class HeaderNotificationArea extends Component
{
    public $modalStatus;
    public $notifications;

    public function render()
    {
        $this->notifications = Notification::all();

        foreach ($this->notifications as $notification) {
            $notification->title = json_decode($notification->data)->title;
            $notification->body = json_decode($notification->data)->message;
        }

        if($this->modalStatus === null) {
            $this->modalStatus = 'none';
        }

        return view('livewire.header-notification-area');
    }

    public function openNotifications($status) {

        if($status === "flex") {
            $this->modalStatus = 'none';
        }

        else {
            $this->notifications = Notification::all();
            $this->modalStatus = 'flex';
        }
    }
}
