<?php
namespace App\Repositories;
use App\Http\Traits\ApiResponse;
use App\Models\ApiFrontend\Cart;
use App\Models\ApiFrontend\CartDetail;
use App\Models\ApiFrontend\Order;
use App\Models\ApiFrontend\OrderDetail;
use App\Models\ApiFrontend\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\payment;
class OrderRepositrie{
    use ApiResponse;

    public function make_order()
    {
        $order = Order::create([
            'user_id' => Auth::user()->id,

        ]);
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        if (!$cart) {
            return $this->api(null, 400, ["user not has a cart"]);
        }


        $cartdetails = CartDetail::with('product')->where('cart_id', $cart->id)->get();
        $total = 0;
        foreach ($cartdetails as $detail) {
            $orderdetail[] =    OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $detail->product_id,
                'count' => $detail->count,
                'total price' => ($detail->product->price) * ($detail->count),
            ]);
            $total += $detail->product->price * $detail->count;

            $count_product = Product::find($detail->product_id)->stock;
            $count_product_cart = Product::find($detail->product_id)->update([

                'count' => ($count_product) - ($detail->count)

            ]);
        }


        CartDetail::where('cart_id', $cart->id)->delete();
        $cart->delete();

        return $this->api($orderdetail, 200, ["Your order maked Sucessfully"]);
    }

    public function show_order_user()
    {

        $user = User::find(Auth::user()->id);
        if (!$user) {
            return $this->api(null, 400, ["user not found please logine"]);
        }
        if (!Order::where('user_id', 1)->exists()) {

            return $this->api(null, 400, [" not found  orders"]);
        }

        $order_ids =  Order::where('user_id', Auth::user()->id)->pluck('id');

        $orderdetails = OrderDetail::wherein('order_id', $order_ids)->get();
        return $this->api($orderdetails, 200, []);
    }
    public function getorders()
    {
        $orders = OrderDetail::all();
        return $this->api($orders, 200, []);
    }

    public function getorder($id)
    {
        if (empty($order = OrderDetail::find($id))) {
            return $this->api([], 400, ["order not found "]);
        }
        return $this->api($order, 200, []);
    }


}
