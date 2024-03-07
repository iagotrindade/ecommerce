<?php

namespace App\Livewire;

use Livewire\Component;
use \App\Models\Order;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Livewire\Attributes\On;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Str;
use App\Http\Handlers\OrderHandler;

class OrdersArea extends Component
{
    public $orders;
    public $filter;
    public $filteredCity;

    public function render()
    {
        if(empty($this->orders)) {
            $this->orders = OrderHandler::processOrdersInfo(Order::orderBy("created_at", "desc")->get());
        }

        return view('livewire.orders-area', [
            'orders' => $this->orders
        ]);
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div class="default-flex" style="height: 60%" >
                <h1 style="color: #FFFFFF">Carregando...</h1>
            </div>
        HTML;
    }

    #[On('searchOrders')]
    public function showSearchedOrders($orders) {
        if(!empty($orders)) {
            $this->orders = OrderHandler::processOrdersInfo($orders);
        }
    }

    public function filterOrders($filter) {
        $this->filter = $filter;


        if($filter) {
            $orders = Order::where('status', 'like', substr($filter, 0, -1))->orWhere('type', 'like', $filter)->get();
        }

        else {
            $orders = Order::orderBy("created_at", "desc")->get();
        }

        $this->orders = OrderHandler::processOrdersInfo($orders);
    }
}

