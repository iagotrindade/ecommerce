<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Handlers\AuthHandler;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    public $user;

    public function index(Request $request, $table = null, $product = null) {
        if(Auth::check()) {
            $this->user = AuthHandler::getAuthUser();
        }

        return view('home', [
            "user" => $this->user,
            'table' => $table,
            'searchProduct' => $product
        ]);
    }

    public function calculateSubtotal()
    {
        $subtotal = 0;

        foreach (session('cart') as $product) {
            $subtotal += $product['product']['price'] * $product['quantity'];

            foreach ($product['addons'] as $addon) {
                $subtotal += $addon['price'] * $addon['quantity'];
            }
        }

        return $subtotal;
    }

    public function calculateTotal()
    {
        $subtotal = $this->calculateSubtotal();
        $discount = 0; // Substitua pelo cálculo real do desconto, se aplicável.
        $deliveryCost = 0; // Substitua pelo cálculo real do custo de entrega.

        $total = $subtotal - $discount + $deliveryCost;

        return max($total, 0); // Garante que o total não seja negativo.
    }
}
