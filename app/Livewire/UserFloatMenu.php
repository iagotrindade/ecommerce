<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Http\Handlers\AuthHandler;

class UserFloatMenu extends Component
{
    public $user;
    public $menuDisplay = 'none';

    public function render()
    {
        $this->user = \App\Http\Handlers\AuthHandler::getAuthUser();
        return view('livewire.user-float-menu');
    }

    public function showMenu() {
        if($this->menuDisplay == 'none') {
            $this->menuDisplay = 'block';
        }

        else {
            $this->menuDisplay = 'none';
        }
    }
}
