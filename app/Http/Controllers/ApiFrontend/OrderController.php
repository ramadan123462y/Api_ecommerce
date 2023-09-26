<?php

namespace App\Http\Controllers\ApiFrontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\ApiFrontend\Cart;
use App\Models\ApiFrontend\CartDetail;
use App\Models\ApiFrontend\Order;
use App\Models\ApiFrontend\OrderDetail;
use App\Models\ApiFrontend\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\OrderRepositrie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\payment;

class OrderController extends Controller
{
    protected $order;
    use ApiResponse;
    public function __construct(OrderRepositrie $order)
    {


        $this->order = $order;
    }
    public function make_order()
    {
        return $this->order->make_order();
    }

    public function show_order_user()
    {
        return $this->order->show_order_user();
    }
    public function getorders()
    {
        return $this->order->getorders();
    }

    public function getorder($id)
    {
        return $this->order->getorder($id);
    }
}
