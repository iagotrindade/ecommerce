<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;

class SearchSiteItemsInput extends Component
{
    public $searchTerm;
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

        return view('livewire.search-site-items-input');
    }

    public function searchProducts()
    {
        if($this->searchTerm != "") {
            $this->products = Product::where('name', 'like', ''.$this->searchTerm.'%')
                        ->get();
        }
    }

    public function searchSiteProduct($productId = null) {
        $this->dispatch('searchSiteProduct', $productId ?: $this->searchTerm);

        if($this->searchTerm != "") {
            $this->products = Product::where('name', 'like', ''.$this->searchTerm.'%')
                                        ->where('status', 'Ativado')
                                    ->get();
        }
    }

    public function redirectToHomeSearch($productId) {
        $product = Product::where('id', $productId)
                        ->where('status', 'Ativado')
                    ->get();
        ;

        session(['searchProduct' => $product]);

        return redirect(route('home'));
    }
}
