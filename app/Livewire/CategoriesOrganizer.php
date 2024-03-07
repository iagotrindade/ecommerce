<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categories;
use Livewire\Attributes\On;


class CategoriesOrganizer extends Component
{

    protected $listeners = ['searchProducts'];
    public $categories;
    public $display;

    public function render()
    {
        if(empty($this->categories)) {
            $this->categories = Categories::orderBy('order_number')->get();
        }
        return view('livewire.categories-organizer');
    }

    #[On('organizeCategories')]
    public function organizeCategoriesModal()
    {

        if($this->display = 'none') {
            $this->display = 'block';
        }

        else {
            $this->display = 'none';
        }
    }

    public function closeOrganizerModal()
    {
        $this->display = 'none';
    }
}
