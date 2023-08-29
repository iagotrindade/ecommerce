<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\PermissionGroups;
use App\Models\Image;

class UserController extends Controller
{
    public function index() {
        //GETTING LOGGEDUSER, USERS LIST AND PERMISSIONS LIST
        $authUser = AuthController::getAuthUser();

        $users = User::all();
        $permissionGroups = PermissionGroups::all();

        //CHANGE PERMISSION ID FOR TEXT
        foreach ($users as $user) {
            foreach ($permissionGroups as $permission) {
                if($user['permission_id'] == $permission['id']) {
                    $user['permissionName'] = $permission['name'];
                }
            }

            $user['image'] = $user->getImage->name;
        }

        //GETTING PERMISSION CONTROLLER
        $permissionsController = PermissionController::class;

        //RENDERING VIEW
        return view('users', [
            'authUser' => $authUser,
            'users' => $users,
            'permissionsController' => $permissionsController,
            'permissionGroups' => $permissionGroups
        ]);
    }

    public function new(Request $request) {
        if($request->hasFile('image') && $request->image->isValid()) {
            $imgName = $request->image->store('avatars/adm');

            $uploadedImage = Image::create([
                "name" => $imgName
            ]);
        }

        else {
            $uploadedImage = Image::find(1);
        }

        $request['username'] = explode("@", $request['email']);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6|confirmed',
            'permission_id' => 'required'
        ]);

        $data = $request->only([
            'name',
            'email',
            'password',
            'permission_id'
        ]);

        $data['image_id'] = $uploadedImage->id;

        $data['username'] = $request['username'][0].'@adm';
        $data['status'] = 'Ativado';
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect(route("users"));
    }

    public function edit(Request $request) {
        $user = User::find($request->user_id);

        $oldImage = Image::find($user->getImage->id);

        if($request->hasFile('image') && $request->image->isValid() ) {
            $imageSend = $request->image->store('avatars/adm');

            $imageSend = Image::create([
                "name" => $imageSend
            ]);

            $imageSend = $imageSend->id;

            if($oldImage->name !== 'avatars/adm/default_avatar.png') {
                $user->update([
                    'image' => 1
                ]);

                $oldImage->delete();

                if(Storage::exists($oldImage->name)) {
                    Storage::delete($oldImage->name);
                }
            }
        }

        else {
            $imageSend = $oldImage->id;
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'permission_id' => 'required',
            'status' => 'required'
        ]);


        if($request->password) {
            $request->validate([
                'password' => 'min:6',
                'new_password' => 'min:6',
            ]);
        }

        $data = $request->only([
            'name',
            'email',
            'password',
            'new_password',
            'permission_id',
            'status'
        ]);



        $data['image_id'] = $imageSend;

        if(Hash::check($data['password'], $user->password)) {
            $data['password'] = $request->new_password;
        }

        else {
            $data['password'] = $user->password;
        }

        $user->update($data);
        $user->save();

        return redirect('users');
    }


    public function delete(Request $request) {
        $data = $request->all();
        $user = User::find($data['user-id']);

        $userImage = Image::where('name', $user['image'])->get();

        if($userImage->isNotEmpty()) {

            $image = Image::find($userImage[0]->id);

            if(Storage::exists($image->name) && $image->name != 'avatars/adm/default_avatar.png') {

                Storage::delete($image->name);

                $image->delete();
            }
        }

        $user->delete();

        return redirect('users');
    }
}
