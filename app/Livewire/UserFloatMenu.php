<?php

namespace App\Livewire;

use Livewire\Component;

class UserFloatMenu extends Component
{
    public $menuDisplay = 'none';
    public function render()
    {
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
