<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\stripeController;

Route::get('/', [HomeController::class,'userHome'])->name('/');
Route::get('/about', function(){return view('user.about');})->name('/about');
Route::get('/shop', function(){return view('user.shop');})->name('/shop');
Route::get('/contact', function(){return view('user.contact');})->name('/contact');

Route::get('/redirect',[HomeController::class,'redirect'])->name('redirect');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    Route::post('/apply-coupon',[CouponController::class,'applyCoupon'])->name('coupon.apply');

    Route::group(['prefix'=>'cart','as'=>'cart.'], function(){
        Route::get('/',[CartController::class,'index'])->name('index');
        Route::post('/{product}', [CartController::class,'addToCart'])->name('add');
        Route::delete('/{product}',[CartController::class,'removeFromCart'])->name('destroy');
        Route::post('/updateQuantity/{id}',[CartController::class,'changeQuantity'])->name('update');
    });

    Route::get('/checkout',[stripeController::class,'index'])->name('stripe.index');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','admin'])->group(function () {
    
    Route::resource('coupons', CouponController::class);

    Route::group(['as'=> 'admin.'],function () {
        Route::get('/showAdmins',[AdminController::class,'index'])->name('index');
        Route::post('/addAdmin',[AdminController::class,'addAdmin'])->name('add');
        Route::delete('/deleteAdmin/{id}',[AdminController::class,'destroy'])->name('destroy');
        Route::get('/admin_products',[ProductController::class,'indexAdmin'])->name('products');
    });

    Route::delete('/deleteImage',[ProductController::class,'destroyImage'])->name('delete.image');
    Route::get('/productsInfo/{product}',[ProductController::class,'showProductInfo'])->name('products.info');

    Route::group(['prefix' => 'categories', 'as' => 'category.'],function(){
        Route::get('/',[CategorieController::class,'index'])->name('index');
        Route::post('/store',[CategorieController::class,'store'])->name('store');
        Route::put('/{category}/update',[CategorieController::class,'update'])->name('update');
        Route::delete('/{category}/delete',[CategorieController::class,'destroy'])->name('destroy');
    });

    Route::group(['prefix'=>'orders','as'=>'orders.'],function(){
        Route::get('/',[OrderController::class,'index'])->name('index');
        Route::post('/{order}/processing',[OrderController::class,'switchStatusProcessing'])->name('processing');
        Route::post('/{order}/shipped',[OrderController::class,'switchStatusShipped'])->name('shipped');
    });
});

Route::resource('products', ProductController::class);