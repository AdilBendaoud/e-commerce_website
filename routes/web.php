<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Routing\Route as RoutingRoute;

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

Route::get('/', function () { return view('user.home');})->name('/');

Route::get('/redirect',[HomeController::class,'redirect'])->name('redirect');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    Route::group(['as'=> 'admin.'],function () {
        Route::get('/showAdmins',[AdminController::class,'index'])->name('index');
        Route::post('/addAdmin',[AdminController::class,'addAdmin'])->name('add');
        Route::delete('/deleteAdmin/{id}',[AdminController::class,'destroy'])->name('destroy');
        Route::get('/admin_products',[ProductController::class,'indexAdmin'])->name('products');
    });
    
    Route::delete('/deleteImage',[ProductController::class,'destroyImage'])->name('delete.image');
    Route::get('/productsInfo/{product}',[ProductController::class,'showProductInfo'])->name('products.info');
    

    Route::group(['prefix'=>'orders','as'=>'orders.'],function(){
        Route::get('/',[OrderController::class,'index'])->name('index');
        Route::post('/{order}/processing',[OrderController::class,'switchStatusProcessing'])->name('processing');
        Route::post('/{order}/shipped',[OrderController::class,'switchStatusShipped'])->name('shipped');
    });

    Route::group(['prefix' => 'categories', 'as' => 'category.'],function(){
        Route::get('/',[CategorieController::class,'index'])->name('index');
        Route::post('/store',[CategorieController::class,'store'])->name('store');
        Route::put('/{category}/update',[CategorieController::class,'update'])->name('update');
        Route::delete('/{category}/delete',[CategorieController::class,'destroy'])->name('destroy');
    });
});

Route::resource('products', ProductController::class);