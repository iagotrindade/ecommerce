<?php

namespace App\Http\Handlers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use \App\Models\Order;
use \App\Models\PurchasedProductAddons;

class OrderHandler
{
    public $processedOrders = [];
    public $processedOrder;

    public static function processOrdersInfo($orders) {
        $processedOrders = [];

        foreach ($orders as $data) {
            switch ($data['status']) {
                case 'RECEIVED':
                    $data['status_color'] = "#71D761";
                    break;

                case 'PENDING':
                    $data['status_color'] = "#FFE500";
                    break;

                case 'Cancelado':
                    $data['status_color'] = "#FF4343";
                    break;
            }

            $data['order_date'] = date('d/m/Y \á\s\ H:m', strtotime($data['created_at']));

            $data['purchasedProducts'] = $data->purchasedProducts;

            $data['totalAmount'] = $data->products->sum('price');

            $processedOrders[] = $data;
        }

        return $processedOrders;
    }

    public static function processOrderInfo($orderId) {
        $order = Order::find($orderId);

        $order['client'] = $order->client;

        switch ($order['status']) {
            case 'RECEIVED':
                $order['status'] = "Pago";
                $order['status_color'] = "#71D761";
                break;

            case 'PENDING':
                $order['status'] = "Pendente";
                $order['status_color'] = "#FFE500";
                break;

            case 'Cancelado':
                $order['status_color'] = "#FF4343";
                break;
        }

        $order['order_date'] = date('d/m/Y \á\s\ H:m', strtotime($order['created_at']));

        $order['purchasedProducts'] = $order->purchasedProducts;

        $addonsPrices = [];

        foreach ($order->products as $product) {
           foreach ($product->purchasedAddons as $addon) {
                $product['addonsPrice'] = $addon->quantity * $addon->addon->price;
                $product['price'] = $product['addonsPrice'] + $order->products->sum('price');
           }
        }

        $order['totalAmount'] = $order->products->sum('price');

        $order['accept_time'] = Carbon::now()->diffInMinutes(Carbon::parse($order['created_at']));



        return $order;
    }
}
