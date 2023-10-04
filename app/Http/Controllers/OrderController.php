<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Order;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OrderController extends Controller
{
    public function index() {
        $authUser = AuthController::getAuthUser();

        return view("orders" , [
            "authUser" => $authUser
        ]);
    }

    public function order(Request $request ) {
        $authUser = AuthController::getAuthUser();

        $orderId = $request->id;

        $order = Order::find($orderId);

        $order['client'] = $order->client;

        $order['purchasedItems'] = $order->pruchasedItems;

        foreach ($order['purchasedItems'] as $product) {
            $orders = $product->purchasesProduts;
        }

        $order['order_date'] = Carbon::parse($order['created_at'])->formatLocalized('%A, %d de %B de %Y, %H:%M:%S na Loja Online');

        return view("order", [
            "order" => $order,
            "authUser" => $authUser
        ]);
    }

    public static function processOrdersInfo($orders) {
        $processedOrders = [];

        foreach ($orders as $data) {
            switch ($data['payment_status']) {
                case 'Pago':
                    $data['payment_color'] = "green-status";
                    break;

                case 'Pendente':
                    $data['payment_color'] = "yellow-status";
                    break;

                case 'Cancelado':
                    $data['payment_color'] = "red-status";
                    break;
            }

            switch ($data['processing_status']) {
                case 'Processado':
                    $data['processing_color'] = "green-status";
                    break;

                case 'Não Processado':
                    $data['processing_color'] = "yellow-status";
                    break;

                case 'Cancelado':
                    $data['processing_color'] = "red-status";
                    break;
            }
            $data['order_date'] = date('d/m/Y - h:m', strtotime($data['created_at']));

            $processedOrders[] = $data;
        }

        return $processedOrders;
    }
}
