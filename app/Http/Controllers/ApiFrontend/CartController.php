<?php

namespace App\Http\Controllers\ApiFrontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\ApiFrontend\Cart;
use App\Models\ApiFrontend\CartDetail;
use App\Models\ApiFrontend\Order;
use App\Models\ApiFrontend\OrderDetail;
use App\Models\ApiFrontend\Product;
use App\Repositories\CartRepositrie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    use ApiResponse;
    protected $cart;
    public function __construct(CartRepositrie $cart)
    {

        $this->cart = $cart;
    }
    public function add_cart(Request $request, $product_id)
    {
        return $this->cart->add_cart($request, $product_id);
    }


    public function show_cart()
    {
        return $this->cart->show_cart();
    }
    public function update_cartdetails(Request $request, $id_detail)
    {

        return $this->cart->update_cartdetails($request, $id_detail);
    }
    public function delete_incart($id)
    {
        return $this->cart->delete_incart($id);
    }
}
