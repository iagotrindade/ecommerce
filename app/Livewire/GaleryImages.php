<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Image;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use Livewire\Attributes\On;
use App\Models\User;


class GaleryImages extends Component
{
    public $authUser;
    public $images;
    public $permissionsController;

    public function render()
    {
        if(empty($this->images)) {
            $this->images = Image::orderBy("created_at", "desc")->get();
        }

        $this->authUser = AuthController::getAuthUser();
        $this->permissionsController = PermissionController::class;

        return view('livewire.galery-images');
    }

    #[On('filterImagesByDate')]
    public function filterImages($images) {
        $this->images = $images;
    }
}
