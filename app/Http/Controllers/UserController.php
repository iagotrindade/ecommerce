<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PermissionGroups;
use App\Models\Image;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Mails\AuthMailController;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CreateUserNotification;
use App\Events\UserRegistration;

class UserController extends Controller
{
    public function index() {
        //GETTING LOGGEDUSER, USERS LIST AND PERMISSIONS LIST
        $authUser = AuthController::getAuthUser();

        $users = User::all();
        $permissionGroups = PermissionGroups::all();

        //GETTING PERMISSION CONTROLLER
        $permissionsController = PermissionController::class;

        //RENDERING VIEW
        return view('users', [
            'authUser' => $authUser,
            'permissionsController' => $permissionsController,
            'permissionGroups' => $permissionGroups
        ]);
    }

    public function new(Request $request) {
        $authUser = AuthController::getAuthUser();

        if($request->hasFile('image') && $request->image->isValid()) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,gif|max:2048'
            ]);

            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($request->image->getMimeType(), $allowedMimeTypes)) {
                $imgName = $request->image->store('avatars/adm');

                $uploadedImage = Image::create([
                    "name" => $imgName
                ]);
            }
        }

        else {
            $uploadedImage = Image::find(1);
        }

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'permission_id' => 'required'
        ]);

        $data = $request->only([
            'name',
            'username',
            'permission_id',
            'email',
            'phone'
        ]);

        $data['image_id'] = $uploadedImage->id;

        $data['status'] = 'Ativado';

        $data['password'] = Str::random(8);

        //AuthMailController::NewUserMail($data);

        $whatsappMessage = "Olá ".$data['name']."! Nós viemos informar que sua conta no Painel Administrativo da Click Shopping está criada! Acesse o link ".url("adm")." e utilize a senha inicial ".$data['password']." para realizar o acesso. Após o seu primeiro acesso, você poderá redefinir sua senha. Caso essa mensagem tenha chegado para você por engano, pedimos gentilmente que desconsidere! Agradecimentos Click Shopping";

        WhatsAppController::sendMessage($data['phone'], $whatsappMessage);

        $passwordToMail = $data['password'];
        $data['password'] = Hash::make($data['password']);

        $newUser = User::create($data);

        Notification::send($newUser, new CreateUserNotification($authUser, $newUser, $passwordToMail));

        $pusherMessage = "Uma nova conta de acesso ao Painel Administrativo foi criado pelo usuário ".$authUser->name."";

        event(new UserRegistration($pusherMessage));

        return redirect(route("users"));
    }

    public function edit(Request $request) {
        $user = User::find($request->user_id);

        $oldImage = Image::find($user->getImage->id);

        if($request->hasFile('image') && $request->image->isValid() ) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,gif|max:2048'
            ]);

            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

            if (in_array($request->image->getMimeType(), $allowedMimeTypes)) {
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
        }

        else {
            $imageSend = $oldImage->id;
        }

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'permission_id' => 'required',
            'status' => 'required'
        ]);

        if($request->email != $user->email) {
            $request->validate([
                'email' => 'required|email|unique:users,email'
            ]);
        }

        if($request->password) {
            $request->validate([
                'password' => 'min:6',
                'new_password' => 'min:6',
            ]);
        }

        $data = $request->only([
            'name',
            'email',
            'username',
            'phone',
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


    public function delete(Request $request, $id) {
        $user = User::find($id);

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

    public static function processUsersListInfo($usersList, $permissionGroups) {
        //CHANGE PERMISSION ID FOR TEXT
        $users = [];
        foreach ($usersList as $user) {
            foreach ($permissionGroups as $permission) {
                if($user['permission_id'] == $permission['id']) {
                    $user['permissionName'] = $permission['name'];
                }
            }

            if(! $user['image']) {
                $user['image'] = User::find($user['id'])->getImage->name;
            }

            $users[] = $user;
        }

        return $users;
    }

    public static function processUserInfo($user, $permissionGroups) {
        //CHANGE PERMISSION ID FOR TEXT

        foreach ($permissionGroups as $permission) {
            if($user->permission_id == $permission->id) {
                $user->permissionName = $permission->name;
            }
        }

        if(! $user->image) {
            $user->image = User::find($user['id'])->getImage->name;
        }

        return $user;
    }
}
