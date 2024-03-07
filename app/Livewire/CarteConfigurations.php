<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Livewire\EditCategoryModal;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\MessageBag;
use App\Models\Product;

class CarteConfigurations extends Component
{
    public $categories;
    public $errorMessages;
    public $searchCategory;
    public $searchProduct;

    public function render()
    {
        return view('livewire.carte-configurations', [
            'errorMessages' => $this->errorMessages
        ]);
    }

    public function mount($categories, $searchid)
    {
        if(is_string($searchid)) {
            $product = Product::find($searchid);

            $this->searchCategory = $product->category;
            $this->searchProduct = $product;
        }

        else {
            $this->categories = $categories;
            $this->searchProduct = $searchid;
        }

    }

    public function editCategory($id)
    {
        $this->dispatch('editCategoryModal', $id);
    }

    public function organizeCategories()
    {
        $this->dispatch('organizeCategories');
    }

    public function changeProductStatus($productId) {
        $product = Product::find($productId);

        if($product->status == 'Ativado') {
            $product->update(['status' => 'Desativado']);
        }
        else {
            $product->update(['status' => 'Ativado']);
        }
    }

    public function editProductModal($productId)
    {
        $this->dispatch('editProductModal', $productId);
    }
}
