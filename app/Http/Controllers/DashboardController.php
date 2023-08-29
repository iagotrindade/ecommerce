<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

class DashboardController extends Controller
{
    public function index() {
        $authUser = AuthController::getAuthUser();
        return view('dashboard', [
            'authUser' => $authUser
        ]);
    }
}
