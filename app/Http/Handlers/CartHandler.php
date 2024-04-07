<?php

namespace App\Http\Handlers;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Session;

class CartHandler {
    public static function calculateSubtotal()
    {
        $subtotal = 0;


        if(session('cart')) {
            foreach (session('cart') as $product) {
                $subtotal += $product['product']['price'] * $product['quantity'];

                foreach ($product['addons'] as $addon) {
                    $subtotal += $addon['price'] * $addon['quantity'];
                }
            }

            return $subtotal;
        }
    }

    public static function calculateTotal()
    {
        if(session('cart')) {
            $subtotal = \App\Http\Handlers\calculateSubtotal();
            $discount = 0; // Substitua pelo cálculo real do desconto, se aplicável.
            $deliveryCost = 0; // Substitua pelo cálculo real do custo de entrega.

            $total = $subtotal - $discount + $deliveryCost;

            return max($total, 0); // Garante que o total não seja negativo.
        }

    }
}
