<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Handlers\AuthHandler;
use App\Models\User;

class DashboardController extends Controller
{
    public $user;

    public function index() {
        $this->user = \App\Http\Handlers\AuthHandler::getAuthUser();

        return view('dashboard', [
            'user' => $this->user
        ]);
    }
}
