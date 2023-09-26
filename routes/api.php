<?php

use App\Http\Controllers\ApiFrontend\AuthController;
use App\Http\Controllers\ApiFrontend\CartController;
use App\Http\Controllers\ApiFrontend\CategorieController;
use App\Http\Controllers\ApiFrontend\OrderController;
use App\Http\Controllers\ApiFrontend\ProductController;
use App\Http\Controllers\PayorderController;
use App\Models\ApiFrontend\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ApiFrontend\Cart;


// ---------------------------auth------------------------


Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::get('url_back', [PayorderController::class, 'GetPaymentStatus']);

Route::group(['middleware' => 'jwt'], function () {




    Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {

        Route::get('logout', 'logout');
        Route::get('profile', 'profile');
        Route::post('update_profile', 'update_profile');
    });
    // ---------------------------product------------------------

    Route::group(['prefix' => 'product', 'controller' => ProductController::class], function () {
        Route::get('get_all_products', 'get_all_products');
        Route::get('get_product_byid/{id}', 'get_product_byid');
    });
    // ---------------------------categories------------------------

    Route::group(['prefix' => 'categories', 'controller' => CategorieController::class], function () {
        Route::get('get_all_categories', 'get_all_categories');
        Route::get('get_category_byid/{id}', 'get_category_byid');
    });
    // ---------------------------cart------------------------

    Route::group(['prefix' => 'cart', 'controller' => CartController::class], function () {

        Route::post('add_cart/{product_id}', 'add_cart');
        Route::get('show_cart', 'show_cart');
        Route::post('update_cartdetails/{id_detail}', 'update_cartdetails');
        Route::get('delete_incart/{id}', 'delete_incart');
    });
    // ---------------------------order------------------------

    Route::group(['prefix' => 'order', 'controller' => OrderController::class], function () {

        Route::post('make_order', 'make_order');
        Route::get('delete_all_cart', 'delete_all_cart');
        Route::get('show_order_user', 'show_order_user');
    });
    // ---------------------------paypay------------------------

    Route::group(['prefix' => 'pay', 'controller' => PayorderController::class], function () {
        Route::get('/', 'order');
        Route::post('store_transection', 'store_transection');
        Route::get('url_back', 'GetPaymentStatus');
    });
});
