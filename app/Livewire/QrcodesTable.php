<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Handlers\AuthHandler;
use App\Models\QrCodes;
use App\Http\Controllers\PermissionController;
use App\Models\PermissionGroups;

class QrcodesTable extends Component
{
    public $display = 'none';
    public $editDisplay = 'none';
    public $qrcode = '';

    public function render()
    {
        $this->authUser = \App\Http\Handlers\AuthHandler::getAuthUser();
        $this->qrcodes = QrCodes::all();
        $permissionGroups = PermissionGroups::all();
        $permissionsController = PermissionController::class;

        return view('livewire.qrcodes-table', [
            'user' => $this->authUser,
            'qrcodes' => $this->qrcodes,
            'permissionsController' => $permissionsController,
            'permissionGroups' => $permissionGroups
        ]);
    }

    public function openAddModal() {
        if($this->display = 'none') {
            $this->display = 'block';
        }

        else {
            $this->display = 'none';
        }
    }

    public function openEditModal($id) {
        $this->qrcode = QrCodes::find($id);

        if($this->editDisplay == 'none') {
            $this->editDisplay = 'block';
        }

        else {
            $this->editDisplay = 'none';
        }
    }
}
