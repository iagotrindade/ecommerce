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
use App\Http\Handlers\AuthHandler;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CreateUserNotification;
use App\Notifications\sendUserPasswordNotification;
use App\Events\UserRegistration;


class UserController extends Controller
{
    public $authUser;

    public function index($id = null) {
        //GETTING LOGGEDUSER, USERS LIST AND PERMISSIONS LIST
        $this->authUser = AuthHandler::getAuthUser();

        $permissionGroups = PermissionGroups::all();

        //GETTING PERMISSION CONTROLLER
        $permissionsController = PermissionController::class;

        //RENDERING VIEW
        return view('users', [
            'authUser' => $this->authUser,
            'permissionsController' => $permissionsController,
            'permissionGroups' => $permissionGroups,
            'id' => $id
        ]);
    }

    public function new(Request $request) {
        $authUser = AuthHandler::getAuthUser();

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

        // Busca todos os usuários
        $users = User::where('permission_id', '1')->get();

        Notification::send($users, new CreateUserNotification($authUser, $newUser));

        $newUser->notify(new sendUserPasswordNotification($authUser, $newUser, $passwordToMail));

        return redirect(route("users"));
    }

    public function edit(Request $request) {
        $user = User::find($request->user_id);
        $this->authUser = AuthHandler::getAuthUser();

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

        $data = $request->only([
            'name',
            'email',
            'username',
            'phone',
            'permission_id',
            'status'
        ]);

        if($request->new_password !== null) {
            $request->validate([
                'password' => 'min:8',
                'new_password' => 'min:8',
            ]);

            if(Hash::check($request->password, $user->password) || $this->authUser->permission_id == 1) {
                $data['password'] = $request->new_password;
            }

            else {
                $data['password'] = $user->password;
            }
        }

        $data['image_id'] = $imageSend;

        $user->update($data);
        $user->save();

        return redirect('usuarios');
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

        return redirect('usuarios');
    }
}
