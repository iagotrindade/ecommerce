<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PermissionGroups;
use App\Models\User;
use App\Models\PermissionItems;
use App\Models\PermissionLinks;
use App\Http\Handlers\authHandler;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Arr;

class PermissionController extends Controller
{
    public $authUser;

    public function index() {
        //GETTING LOGGEDUSER, PERMISSIONS LIST AND PERMISSIONS ITEMS
        $this->authUser = \App\Http\Handlers\AuthHandler::getAuthUser();
        $permissionGroups = PermissionGroups::all();
        $permissionItems = PermissionItems::all();
        $permissionLinks = PermissionLinks::all();

        foreach($permissionGroups as $group) {
            $group['qtd'] = count(User::where('permission_id', $group->id)->get());
        }

        $permissionLinks = [];
        $itemsArray = [];

        foreach($permissionGroups as $group) {
            $group['permissionItems'] = PermissionLinks::select('permission_item_id')->where('permission_group_id', $group->id)->get();
        }

        //GETTING PERMISSION CONTROLLER
        $permissionsController = PermissionController::class;

        //RENDERING VIEW
        return view('permissions', [
            'authUser' => $this->authUser,
            'permissionsController' => $permissionsController,
            'permissionGroups' => $permissionGroups,
            'permissionItems' => $permissionItems,
        ]);
    }

    public function new(Request $request) {
        $data = $request;
        $permissionsItemsIds = explode(',', $data->permissions_list);

        if($permissionsItemsIds[0] != '') {
            $newGroup = PermissionGroups::create([
                'name' => $data->name
            ]);

            foreach ($permissionsItemsIds as $permissionItemId) {
                PermissionLinks::create([
                    'permission_item_id' => $permissionItemId,
                    'permission_group_id' => $newGroup->id
                ]);
            }

            return redirect('permissions');
        }

        else {
            return redirect(route('permissions'))->withErrors(['vazio' => 'É preciso selecionar ao menos uma permissão!']);
        }
    }

    public function edit(Request $request) {
        $request->validate([
            'groupId' => 'required',
            'name' => 'required|min:6',
        ]);

        $data = $request->only([
            'groupId',
            'name',
            'permissions_list'
        ]);

        $group = PermissionGroups::find($data['groupId']);

        $updatedGroup = $group->update([
            'name' => $data['name']
        ]);
        $group->save();

        if(!is_null($data['permissions_list'])) {
            $permissionsItemsIds = explode(',', $data['permissions_list']);

            PermissionLinks::where('permission_group_id', $group->id)->delete();

            foreach ($permissionsItemsIds as $permissionItemId) {
                PermissionLinks::create([
                    'permission_item_id' => $permissionItemId,
                    'permission_group_id' => $group->id
                ]);
            }
        }

        return redirect(route('permissions'));
    }

    public function delete(Request $request) {
        $data = $request;
        $permissionGroup = PermissionGroups::find($data->id);

        $users = User::select()->where('permission_id', $data->id)->get();

        if(empty($users[0])) {
            $permissionGroup->delete($data->id);
        }

        else {
            return redirect(route('permissions'))->withErrors(['negado' => 'Existem usuários com este grupo de permissão!']);
        }

        return redirect('permissions');
    }

    public static function hasPermission($permissionSlug, $userPermissions) {
        if(in_array($permissionSlug, $userPermissions)) {
            return true;
        }

        else {
            return false;
        }
    }
}
