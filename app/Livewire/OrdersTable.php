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

class OrdersTable extends Component
{
    public $orders;
    public $filter;
    public $filteredCity;

    public function render()
    {

        if(empty($this->orders)) {
            $this->orders = OrderController::processOrdersInfo(Order::orderBy("created_at", "desc")->get());
        }

        $ordersCities = Order::select('order_city')->get();

        return view('livewire.orders-table', [
            'ordersCities' => $ordersCities
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
            $this->orders = OrderController::processOrdersInfo($orders);
        }
    }

    public function filterOrders($filter) {
        $this->filter = $filter;

        if($filter != "Todos") {
            $orders = Order::where('payment_status', substr($filter, 0, -1))->orWhere('processing_status', substr($filter, 0, -1))->get();
        }

        else {
            $orders = Order::orderBy("created_at", "desc")->get();
        }

        $this->orders = OrderController::processOrdersInfo($orders);
    }

    public function filterOrdersByCity() {
        if($this->filteredCity != 'Todos os Locais') {
            $orders = Order::where('order_city', $this->filteredCity)->get();
        }

        else {
            $orders = Order::orderBy("created_at", "desc")->get();
        }

        $this->orders = OrderController::processOrdersInfo($orders);
    }
}

