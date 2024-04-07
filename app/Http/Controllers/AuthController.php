<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\PermissionGroups;
use App\Models\Permissionitems;
use App\Models\PermissionLinks;
use App\Models\Image;
use App\Models\PasswordResetToken;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use App\Notifications\LoginAttemptNotification;
use App\Notifications\AccountLoginNotification;
use App\Notifications\ResetPasswordActionNotification;
use App\Http\Handlers\AuthHandler;

class AuthController extends Controller
{
    public function index(Request $request) {
        if(Auth::check()) {
            return redirect('orders');
        };

        return view("login");
    }

    public function loginAction(Request $request) {
        $validator = $request->validate([
            "email" => "required|email",
            "password" => "required|min:8",
        ]);


        $validator['remember'] = $request->remember;

        session()->put('remember', $validator['remember']);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if($user->status == 'Desativado') {
                return redirect(route('login', ['userId' => $user->id]))->withErrors(['status' => 'O usuário informado está desativado!']);
            }

            $accessDetails = \App\Http\Handlers\AuthHandler::getAccessDetails($request);

            \App\Http\Handlers\AuthHandler::sendVerificationCode($user,  $accessDetails);

            return view('verify_login', [
                'userId' => $user->id
            ]);
        }

        else {
            return redirect(route('login'))->withErrors(['campo' => 'A senha e/ou o email estão incorretos!']);
        }
    }

    public function verifyLogin(Request $request) {
        return view("verify_login");
    }

    public function confirmLoginAction(Request $request) {
        $user = User::find($request->userId);

        $code = "";
        foreach ($request->code as $number) {
            $code = $code.$number;
        }

        if(Hash::check($code, $user->login_hash) && !Carbon::parse($user->expiration_time)->isPast()) {
            $remember = session('remember');

            if($remember  === "on") {
                $remember = true;
            }
            else {
                $remember = false;
            }

            Auth::loginUsingId($request->userId, $remember);

            $accessDetails = \App\Http\Handlers\AuthHandler::getAccessDetails($request);

            $user->notify(new AccountLoginNotification($user, $accessDetails));

            $user->update([
                'login_hash' => '',
                'expiration_time' => Carbon::now()
            ]);

            //Redireciona o SITE se for um cliente ou ao DASHBOARD se for um usuário
            return redirect($user->permission->name === "Cliente" ? route('home') : route('orders'));
        }

        else {
            return view('verify_login', [
                'userId' => $user->id
            ])->withErrors(['campo' => 'O código informado é inválido ou expirou!']);
        }
    }

    public function resendConfirmationCode($userId) {
        $user = User::find($userId);

        $accessDetails = "";

        \App\Http\Handlers\AuthHandler::sendVerificationCode($user, $accessDetails);

        return view('verify_login', [
            'userId' => $user->id
        ])->withErrors(['newCode' => 'Um novo código foi enviado para seu email!']);
    }

    public function forgotPassword (Request $request) {
        return view('forgot_password');
    }

    public function forgotPasswordAction(Request $request) {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->get();

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->withErrors(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }


    public function changePassword(Request $request) {
        $token = $request->query('token');

        return view("change_password", [
            'token' => $token
        ]);
    }

    public function changePasswordAction(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $this->accessDetails = \App\Http\Handlers\AuthHandler::getAccessDetails($request);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                if($user->save()) {
                    if ($user) {
                        $user->notify(new ResetPasswordActionNotification($user->name, $this->accessDetails));
                    }
                };

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->withErrors(['status' => [__($status)]])
                : back()->withErrors(['email' => __($status)]);

    }

    public function logout($id) {
        $user = User::find($id);

        Auth::logout();
        Session::invalidate();

        return redirect()->route($user->permission->name == 'Cliente' ? 'home' : 'login');
    }
}
