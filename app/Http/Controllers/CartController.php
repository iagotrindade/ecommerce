<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Handlers\AuthHandler;

class CartController extends Controller
{
    public $user;

    public function index(Request $request) {
        if(Auth::check()) {
            $this->user = \App\Http\Handlers\AuthHandler::getAuthUser();
        }

        return view('cart', [
            "user" => $this->user
        ]);
    }
}
