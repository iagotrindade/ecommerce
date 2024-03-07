<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Order;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Handlers\AuthHandler;
use App\Http\Handlers\OrderHandler;

class OrderController extends Controller
{
    public $user;

    public function index() {
        $this->user = AuthHandler::getAuthUser();

        return view("orders" , [
            "user" => $this->user
        ]);
    }

    public function order(Request $request ) {
        $this->user = AuthHandler::getAuthUser();
        $orderId = $request->id;

        $order = OrderHandler::processOrderInfo($orderId);

        return view("order", [
            "order" => $order,
            "user" => $this->user
        ]);
    }

    public function refund(Request $request ) {
        $order = Order::find($request->id);

        if(!empty($order)) {
            if($order->payment_id === NULL) {
                return redirect(route('order', $order->id))->withErrors([
                    'notPix' => 'O pedido não foi pago via PIX!'
                ]);
            }
        }
        //FAZER O REEMBOLSO VIA AASAS
    }
}
