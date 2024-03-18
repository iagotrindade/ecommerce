<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class MobileProfileArea extends Component
{   
    public $user;
    public $profileDisplay = "none";

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
}
