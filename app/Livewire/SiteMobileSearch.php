<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\Attributes\On;

class SiteMobileSearch extends Component
{
    public $mobileDisplay = 'none';
    public $searchTerm;
    public $products;

    public function render()
    {
        return view('livewire.site-mobile-search');
    }

    public function mobileSearchSiteProduct() {
        $this->dispatch('searchSiteProducts', $this->searchTerm);
    }

    #[On('openMobileSearch')]
    public function openMobileSearch() {
        if($this->mobileDisplay == 'none') {
            $this->mobileDisplay = 'flex';
        }   else {
            $this->mobileDisplay = 'none';
        }
    }

}
