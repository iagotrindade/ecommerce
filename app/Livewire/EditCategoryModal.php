<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Categories;

class EditCategoryModal extends Component
{
    public $category;
    public $display;
    protected $listeners = ['editCategoryModal'];

    public function render()
    {
        if(empty($this->category)) {
            $this->category = Categories::find(1);
        }

        return view('livewire.edit-category-modal');
    }

    public function editCategoryModal($id)
    {
        $this->category = Categories::find($id);

        if($this->display = 'none') {
            $this->display = 'block';
        }

        else {
            $this->display = 'none';
        }
    }
}
