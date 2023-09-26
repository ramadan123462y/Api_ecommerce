<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ApiFrontend\CategorieController;
use App\Http\Controllers\ApiFrontend\OrderController;
use App\Http\Controllers\ApiFrontend\ProductController;
use App\Http\Controllers\PayorderController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

// crud categorie-------------------
Route::group(['prefix' => 'auth', 'controller' => AdminAuthController::class], function () {

    Route::post('register', 'register');
    Route::post('login', 'login');

});



Route::group(['middleware'=>'jwtadmin'],function(){




Route::group(['prefix' => 'auth', 'controller' => AdminAuthController::class], function () {


    Route::get('profile', 'profile');
    Route::post('update_profile', 'update_profile');
    Route::post('logout', 'logout');
});
Route::group(['prefix' => 'categorie', 'controller' => CategorieController::class], function () {


    Route::post('update', 'update');
    Route::post('store', 'store');
    Route::post('destroy', 'destroy');
    Route::get('get_all_categories', 'get_all_categories');
});
Route::group(['prefix' => 'product', 'controller' => ProductController::class], function () {
    Route::get('get_all_products', 'get_all_products');
    Route::post('store', 'store');
    Route::post('update', 'update');
    Route::post('destroy', 'destroy');
});
Route::group(['prefix' => 'order', 'controller' => OrderController::class], function () {

    Route::get('getorder/{id}', 'getorder');
    Route::get('getorders', 'getorders');
});
Route::group(['prefix' => 'transection', 'controller' => PayorderController::class], function () {

    Route::get('gettransections', 'gettransections');
    Route::get('getOneTransaction/{id}', 'getOneTransaction');
});
});
