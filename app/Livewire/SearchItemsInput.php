<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class SearchItemsInput extends Component
{
    public $searchTerm;
    public $orders = [];
    public $users = [];
    public $products = [];
    public $display;
    public $border;

    public $areaHeight;
    public $areaOverflow;

    public function render()
    {
        if(!empty($this->searchTerm)) {
            $this->areaHeight = '350px';
            $this->areaOverflow = 'scroll';
            $this->display = 'initial';
            $this->border = '0';
        }
        else {
            $this->areaHeight = '48px';
            $this->areaOverflow = 'hidden';
            $this->display = 'none';
            $this->border = '24px';
        }

        return view('livewire.search-items-input');
    }

    public function searchAll()
    {
        if($this->searchTerm != "") {
            $this->orders = Order::where('code', 'LIKE', '%' . $this->searchTerm . '%')
                            ->get();

            $this->users = User::where('name', 'like', ''.$this->searchTerm.'%')
                            ->orWhere('email', 'like', ''.$this->searchTerm.'%')
                        ->get();

            //$this->categories = Category::where('name', 'like', ''.$this->searchTerm.'%')
                        //->get();

            $this->products = Product::where('name', 'like', ''.$this->searchTerm.'%')
                        ->get();
        }
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
