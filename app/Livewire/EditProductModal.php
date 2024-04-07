<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class EditProductModal extends Component
{
    protected $listeners = ['editProductModal'];
    public $product;
    public $display;
    public $detailsDisplay = 'flex';
    public $complementsDisplay = 'none';
    public $newAddons = [];


    public function render()
    {
        return view('livewire.edit-product-modal');
    }

    public function editProductModal($productId) {
        $this->product = Product::find($productId);

        if($this->display = 'none') {
            $this->display = 'block';
        }

        else {
            $this->display = 'none';
        }
    }

    public function changeTab($event) {
        if($event === "Detalhes") {
            $this->detailsDisplay = "flex";
            $this->complementsDisplay = "none";
        }

        else {
            $this->detailsDisplay = "none";
            $this->complementsDisplay = "block";
        }
    }

    public function addNewComplement()
    {
        $newComplement = [
            'name' => '', // Defina o valor inicial conforme necessário
            'price' => '', // Defina o valor inicial conforme necessário
        ];
        array_push($this->newAddons, $newComplement);
    }
}
