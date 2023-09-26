<?php

namespace App\Http\Controllers\ApiFrontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use App\Models\ApiFrontend\Product;
use App\Repositories\ProductRepositrie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ApiResponse;
    protected $product;
    public function __construct(ProductRepositrie $product)
    {

        $this->product = $product;
    }
    public function get_all_products()
    {
        return $this->product->get_all_products();
    }
    public function get_product_byid($id)
    {

        return $this->product->get_product_byid($id);
    }
    public function store(Request $request)
    {
        return $this->product->store($request);
    }
    public function update(Request $request)
    {
        return $this->product->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->product->destroy($request);
    }
}
