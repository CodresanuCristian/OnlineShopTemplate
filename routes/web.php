<?php

use App\Http\Controllers\GuitarsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

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






// Home Page ===================================================================================
Route::get('/', function () {
    if (! session()->has('user'))       session()->put('user','Guest');
    if (! session()->has('fav_item'))   session()->put('fav_index', 0);
    if (! session()->has('cart_item'))  session()->put('cart_index', 0);

    return view('home');
});

// Guitars Page ================================================================================
Route::get('/default_guitars', [GuitarsController::class, 'DefaultView']);
Route::get('/custom_guitars', [GuitarsController::class, 'CustomView']);
Route::get('/get_filters', [GuitarsController::class, 'GetFilters']);




// Products Info ===============================================================================
Route::get('/product-info/{category}/{product}', [ProductsController::class, 'ProductInfo']);
Route::get('/addcart', [ProductsController::class, 'AddToCart']);
Route::get('/delcart', [ProductsController::class, 'DelFromCart']);
Route::get('/addfav', [ProductsController::class, 'AddToFav']);
Route::get('/delfav', [ProductsController::class, 'DelFromFav']);
Route::post('/posts', [ProductsController::class, 'PostComment']);





// Favourite and Cart
Route::get('/favourite', function(){
    $total = 0;
    if (session('fav_index') != 0)
        foreach (session('fav_price') as $price)
            $total = $total + $price;
    session()->put('fav_total', $total);

    return view('favourite');
});

Route::get('/cart', function(){
    $total = 0;
    
    if (session('cart_index') != 0)
        foreach (session('cart_price') as $price)
            $total = $total + $price;
    session()->put('cart_total', $total);

    return view('cart');
});

Route::get('/checkout', function(){
    $total = 0;
    
    if (session('cart_index') != 0)
        foreach (session('cart_price') as $price)
            $total = $total + $price;
    session()->put('cart_total', $total);

    return view('checkout');
});



// Account
Route::get('/login', function(){
    if (session('user') != 'Guest')
        return redirect('/logout');
    else
        return view('login');
});
Route::post('/login',[AccountController::class, 'Login']);
Route::get('/logout',[AccountController::class, 'Logout']);
Route::get('/signup', function(){
    return view('signup');
});
Route::post('/register',[AccountController::class, 'Signup']);



// Admin =======================================================================================
Route::get('/admin', function () {
    return view('admin');
});
Route::get('/add-products', [AdminController::class, 'AddProducts']);



// TEST ==============================================
Route::get('/test', function () {
    return view('test');
});