<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Session;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', function () {
    Session::forget('user');
    return redirect('login');
});

//Route::get('/register', function () {
//    return view('login');
//});

Route::post("/login", [UserController::class, 'login']);
Route::get("/", [ProductController::class, 'index']);
Route::get("detail/{id}", [ProductController::class, 'detail']);
Route::get("search", [ProductController::class, 'search']);
Route::post("add_to_cart", [ProductController::class, 'addToCart']);
Route::get("cartlist", [ProductController::class, 'cartList']);
Route::get("removecart/{id}", [ProductController::class, 'removeCart']);
Route::get("ordernow", [ProductController::class, 'orderNow']);
Route::view('register', 'register');
Route::post("/register", [UserController::class, 'register']);
Route::post("orderplace", [ProductController::class, 'orderplace']);
Route::get("myorders", [ProductController::class, 'myOrders']);
Route::get("admin/orders", [ProductController::class, 'myOrdersAdmin'])->middleware('admin');
Route::post("admin/orders/edit", [ProductController::class, 'editOrder']);
Route::view('upload', 'upload');
Route::post('upload', [ProductController::class, 'upload']);
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::resource('products', ProductController::class);
Route::post('/upload', 'ProductController@store')->name('product.store');
Route::post('/storeOrder', [ProductController::class, 'storeOrder']);
