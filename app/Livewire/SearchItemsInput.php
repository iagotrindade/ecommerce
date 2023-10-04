<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\User;

class SearchItemsInput extends Component
{
    public $searchFunction;
    public $searchTerm;

    public function render()
    {
        return view('livewire.search-items-input');
    }

    public function mount($searchFunction = "")
    {
        $this->searchFunction = $searchFunction;
    }

    public function searchOrders()
    {
        if($this->searchTerm != "") {
            $orders = Order::where('code', 'like', ''.$this->searchTerm.'%')
                        ->orWhere('client_name', 'like', ''.$this->searchTerm.'%')
                    ->get();
        }

        else {
            $orders = Order::all();
        }

        $this->dispatch('searchOrders', orders: $orders);
    }

    public function searchUsers() {
        if($this->searchTerm != "") {
            $users = User::where('name', 'like', ''.$this->searchTerm.'%')
                        ->orWhere('username', 'like', ''.$this->searchTerm.'%')
                        ->orWhere('email', 'like', ''.$this->searchTerm.'%')
                    ->get();
        }

        else {
            $users = User::all();
        }

        foreach ($users as $user) {
            $user->image = $user->getImage->name;
        }

        $this->dispatch('searchUsers', $users);
    }
}
