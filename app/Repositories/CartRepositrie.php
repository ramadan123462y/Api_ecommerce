<?php

namespace App\Repositories;

use App\Http\Traits\ApiResponse;
use App\Models\ApiFrontend\Cart;
use App\Models\ApiFrontend\CartDetail;
use App\Models\ApiFrontend\Order;
use App\Models\ApiFrontend\OrderDetail;
use App\Models\ApiFrontend\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartRepositrie
{

    use ApiResponse;
    public function add_cart($request, $product_id)
    {
        try {
            if (!$cart_user = Cart::where('user_id', Auth::user()->id)->exists()) {
                $cart = Cart::create([
                    'user_id' => Auth::user()->id

                ]);
            }
            $cart = Cart::where('user_id', Auth::user()->id)->first();


            if (!$product = Product::find($product_id)) {

                return $this->api('null', 401, ["product not found "]);
            } else {

                if (Product::find($product_id)->stock == 0) {
                    return $this->api('null', 401, ["product empty in shop"]);
                }
            }

            if (CartDetail::where('cart_id', $cart->id)->where('product_id', $product_id)->exists()) {

                return $this->api('null', 200, ["product already exit in cart"]);
            }


            CartDetail::create([
                'cart_id' => $cart->id,
                'product_id' => $product_id,
                'count' => 1,
            ]);


            return $this->api(Product::find($product_id), 200, ["Product Added Cart"]);
        } catch (\Exception $e) {

            return $this->api(null, 200, [$e->getMessage()]);
        }
    }
    public function show_cart()
    {
        try {
            if (!Cart::where('user_id', Auth::user()->id)->first()) {

                return    $this->api(null, 401, ["no cart details"]);
            }
            $cart_details = Cart::where('user_id', Auth::user()->id)->first()->cartdetails;
            return $this->api($cart_details, 200, []);
        } catch (\Exception $e) {

            return $this->api(null, 400, [$e->getMessage()]);
        }
    }
    public function update_cartdetails($request, $id_detail)
    {

        $validation = Validator::make($request->all(), [

            'count' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->api(null, 400, [$validation->errors()]);
        }

        if (!CartDetail::find($id_detail)) {


            return $this->api([], 400, ["Row of cart  id not found"]);
        }
        $product_id = CartDetail::find($id_detail)->product_id;
        if ($stokk = Product::find($product_id)->stock <  $request->count) {
            return $this->api('null', 200, ["product empty in shop avalible:" . Product::find($product_id)->stock]);
        }

        $cart =  Cart::where('user_id', Auth::user()->id)->first();

        $cart_detail =  CartDetail::find($id_detail)->update([
            'cart_id' => $cart->id,

            'count' => $request->count
        ]);
        return $this->api($cart_detail, 200, ["data updated sicessfully"]);
    }
    public function delete_incart($id)
    {
        try {
            if ($cart =  CartDetail::find($id)) {

                $cart->delete();
                return $this->api(null, 200, ["row of cart deleted Sucessfully"]);
            } else {

                return $this->api(null, 400, ["row of cart now found"]);
            }
        } catch (\Exception $e) {

            return $this->api(null, 400, [$e->getMessage()]);
        }
    }
}
