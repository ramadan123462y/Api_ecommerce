<?php

namespace App\Repositories;

use App\Http\Traits\ApiResponse;
use App\Models\ApiFrontend\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductRepositrie
{

    use ApiResponse;
    public function get_all_products()
    {
        try {
            $products =  Product::all();
            return $this->api($products, 200, []);
        } catch (\Exception $e) {
            return $this->api(null, 400, [$e->getMessage()]);
        }
    }
    public function get_product_byid($id)
    {

        $product = Product::find($id);
        if ($product) {

            return $this->api($product, 200, []);
        } else {

            return $this->api(null, 400, ["product not found"]);
        }
    }

    public function store($request)
    {


        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'price' => 'required',
            'stock' => 'required',
            'categorie_id' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->api([], 400, [$validation->errors()]);
        } else {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'categorie_id' => $request->categorie_id,


            ]);


            return $this->api($product, 200, ["product added Sucessfully"]);
        }
    }
    public function update($request)
    {


        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'price' => 'required',
            'stock' => 'required',
            'categorie_id' => 'required',
            'id' => 'required'

        ]);

        if ($validation->fails()) {
            return $this->api([], 400, [$validation->errors()]);
        } else {
            if (empty(Product::find($request->id)->id)) {

                return $this->api([], 400, ['product not found ']);
            }
            $product = Product::find($request->id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'categorie_id' => $request->categorie_id,


            ]);


            return $this->api($product, 200, ["product updated Sucessfully"]);
        }
    }
    public function destroy($request)
    {


        $validation = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->api([], 400, [$validation->errors()]);
        } else {
            if (empty(Product::find($request->id)->id)) {

                return $this->api([], 400, ["Product not found"]);
            }


            $categorie =  Product::find($request->id)->delete();
            return $this->api($categorie, 200, ["Product delete Sucessfully"]);
        }
    }
}
