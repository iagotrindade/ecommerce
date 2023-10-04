<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PermissionGroups;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermissionController;
use Livewire\Attributes\On;

class EditUserModal extends Component
{
    public $userEdited;
    public $loadWarning;

    public function render()
    {
        $this->userEdited = User::find(1);
        $this->loadWarning = "";

        $authUser = AuthController::getAuthUser();
        $permissionsController = PermissionController::class;

        $permissionGroups = PermissionGroups::all();
        return view('livewire.edit-user-modal', [
            'authUser' => $authUser,
            'permissionGroups' => $permissionGroups,
            'permissionsController' => $permissionsController,
            'userEdited' => $this->userEdited
        ]);
    }


    public function updating()
    {
        $this->loadWarning = "Carregando";
    }

    public function updated()
    {
        $this->loadWarning = "";
    }

    #[On('openEditModal')]
    public function setUserData($user) {
        $this->userEdited = $user;
    }
}
