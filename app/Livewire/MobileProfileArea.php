<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class MobileProfileArea extends Component
{   
    public $user;
    public $profileDisplay = "none";
    public $myDataDisplay = "none";
    public $myOrdersDisplay = "none";
    public $myFavoritesDisplay = "none";

    public function render()
    {
        return view('livewire.mobile-profile-area');
    }

    #[On('openProfileTab')]
    public function showProfileTab() {
        if($this->profileDisplay == "none") {
            $this->profileDisplay = "block";
        }

        else {
            $this->profileDisplay = "none";
        }
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    public function showMyDataTab() {
        if($this->myDataDisplay == "block") {
            $this->myDataDisplay = "none";
        } else {
            $this->myDataDisplay = "block";
        }

        $this->myOrdersDisplay = "none";
        $this->myFavoritesDisplay = "none";
    }

    public function showMyOrdersTab() {
        if($this->myOrdersDisplay == "block") {
            $this->myOrdersDisplay = "none";
        } else {
            $this->myOrdersDisplay = "block";
        }

        $this->myDataDisplay = "none";
        $this->myFavoritesDisplay = "none";
    }

    public function showMyFavoritesTab() {
        if($this->myFavoritesDisplay == "block") {
            $this->myFavoritesDisplay = "none";
        } else {
            $this->myFavoritesDisplay = "block";
        }

        $this->myDataDisplay = "none";
        $this->myOrdersDisplay = "none";
    }
}
