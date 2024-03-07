<?php

namespace App\Livewire;

use Livewire\Component;

class SiteLoginTable extends Component
{
    public $loginTabDisplay = 'none';

    public function render()
    {
        return view('livewire.site-login-table');
    }

    public function showLoginTab() {
        if($this->loginTabDisplay == 'none') {
            $this->loginTabDisplay = 'block';
        }

        else {
            $this->loginTabDisplay = 'none';
        }
    }
}
