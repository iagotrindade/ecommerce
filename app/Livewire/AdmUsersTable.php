<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use App\Models\User;
use App\Models\PermissionGroups;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Livewire\Attributes\On;

class AdmUsersTable extends Component
{
    public $authUser;
    public $users = null;
    #[Rule('image|max:1024')]
    public $userEditedTemp;
    public $userEditedImageTemp;
    public $userEdited = null;
    public $permissionGroups;
    public $modalSatus;

    use WithFileUploads;

    public function render()
    {
        $this->authUser = AuthController::getAuthUser();
        $this->permissionGroups = PermissionGroups::all();

        if($this->users === null) {
            $users = User::all();

            $this->users = UserController::processUsersListInfo($users, $this->permissionGroups);
        }

        //GETTING PERMISSION CONTROLLER
        $permissionsController = PermissionController::class;

        return view('livewire.adm-users-table', [
            'permissionsController' => $permissionsController
        ]);
    }

    public function openEditModal($userId) {
        if ($this->userEdited === null) {
            $this->userEdited = UserController::processUserInfo(User::find($userId), $this->permissionGroups);

            $this->userEditedTemp = [
                'id' => $this->userEdited->id,
                'image' => null,
                'imageName' => $this->userEdited->image,
                'name' => $this->userEdited->name,
                'username' => $this->userEdited->username,
                'email' => $this->userEdited->email,
                'phone' => $this->userEdited->phone,
                'status' => $this->userEdited->status,
                'permission' => $this->userEdited->permission_id,
                'permissionName' => $this->userEdited->permissionName,
            ];
        }

        $this->modalSatus = 'initial';
    }

    public function changeAccess($userStatus) {
        if ($this->userEdited !== null) {
            $this->userEditedTemp['status'] = $userStatus;
        }
    }

    public function changePermission($userPermission) {
        if ($this->userEdited !== null) {
            $this->userEditedTemp['permission'] = $userPermission;
        }
    }

    #[On('searchUsers')]
    public function searchUsers($users) {
        $this->users = UserController::processUsersListInfo($users, $this->permissionGroups);
    }

    public function updatedUserEditedImageTemp()
    {
        $this->userEditedTemp['image'] = $this->userEditedImageTemp;
    }
}
