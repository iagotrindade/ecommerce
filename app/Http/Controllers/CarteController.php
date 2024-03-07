<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Handlers\AuthHandler;
use App\Models\User;
use App\Models\Categories;


class CarteController extends Controller
{
    public $user;

    public function index($id = null) {
        $this->user = AuthHandler::getAuthUser();
        $this->categories = Categories::orderBy('order_number')->get();

        return view('carte', [
            'user' => $this->user,
            'categories' => $this->categories,
            'searchId' => $id
        ]);
    }
}
