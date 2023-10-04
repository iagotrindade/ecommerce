<?php

namespace App\Livewire;
use App\Models\Image;

use Livewire\Component;

class GaleryFilter extends Component
{
    public $filter;

    public function render()
    {
        return view('livewire.galery-filter');
    }

    public function filterImagesByDate() {
        if($this->filter == "Mais Atual") {
            $images = Image::orderBy("created_at", "desc")->get();
        }
        else {
            $images = Image::orderBy("created_at", "asc")->get();
        }

        $this->dispatch('filterImagesByDate', images: $images);
    }
}
