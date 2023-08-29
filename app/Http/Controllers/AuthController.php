<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Permissionitems;
use App\Models\PermissionLinks;
use App\Models\Image;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Mails\AuthMailController;

class AuthController extends Controller
{
    public function index(Request $request) {
        if(Auth::check()) {
            return redirect('dashboard');
        };

        return view("adm_login");
    }

    public function loginAction(Request $request) {
        $validator = $request->validate([
            "email" => "required|email",
            "password" => "required|min:6",
        ]);

        $validator['remember'] = $request->remember;

        session()->put('validator', $validator);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if($user->status == 'Desativado') {
                return redirect(route('login', ['userId' => $user->id]))->withErrors(['status' => 'O usuário informado está desativado!']);
            }

            $code = strval(mt_rand(100000, 999999));
            $expiration = Carbon::now()->addMinutes(10);

            $user->update([
                'login_hash' => Hash::make($code),
                'expiration_time' => $expiration
            ]);

            $user['login_hash'] = $code;

            AuthMailController::loginCodeMail($user);

            return view('confirm_adm_login', [
                'userId' => $user->id
            ]);
        }

        else {
            return redirect(route('login'));
        }
    }

    public function confirmLogin(Request $request) {
        return view('confirm_adm_login', [
            'userId' => $request->userId
        ]);
    }

    public function confirmLoginAction(Request $request) {
        $data = $request;

        $user = User::find($data->userId);

        if(Hash::check($data->code, $user->login_hash) && !Carbon::parse($user->expiration_time)->isPast()) {
            $validator = session('validator');

            if($validator['remember'] === "on") {
                $remember = true;
            }
            else {
                $remember = false;
            }

            if(Auth::attempt(['email' => $validator['email'], 'password' => $validator['password']], $remember)) {
                return redirect(route('dashboard'));
            };
        }

        else {
            return redirect(route('confirm.adm.login', ['userId' => $user->id]))->withErrors(['campo' => 'O código informado é inválido ou expirou!']);
        }
    }

    public function logout() {
        Auth::logout();
        Session::invalidate();

        return redirect()->route('login');
    }

    public static function getAuthUser() {
        //GETTING THE LOGGEDUSER
        $authUser = Auth::user();

        //GETTING USER PERMISSION IMAGE
        $authUser['image'] = $authUser->getImage->name;

        //GETTING USER PERMISSION
        $authUser['permission'] = $authUser->permission;

        //GETTING USER PERMISSION ITEMS
        $permissionItemsIds = array();
        foreach (PermissionLinks::where('permission_group_id', $authUser['permission']['id'])->get() as $item) {
            $permissionItemsIds[] = $item['permission_item_id'];
        }

        $permissionItemsSlugs = array();
        foreach (PermissionItems::whereIn('id', $permissionItemsIds)->get() as $item) {
            $permissionItemsSlugs[] = $item['slug'];
        }

        $authUser['permissionSlugs'] = $permissionItemsSlugs;

        //GETTING USER PERMISSION NAME
        $authUser['permissionName'] = $authUser->permission['name'];

        return $authUser;
    }
}
