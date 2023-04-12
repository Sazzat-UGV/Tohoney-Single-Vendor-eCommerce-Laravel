<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\cardController;
use App\Http\Controllers\Frontend\Customercontroller;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('')->group(function(){
    Route::get('/',[HomeController::class,'home'])->name('home');
    Route::get('/shop',[HomeController::class,'shopPage'])->name('shop.page');
    Route::get('/single-product/{product_slug}',[HomeController::class,'productdetails'])->name('productdetail.page');
    Route::get('/shopping-card',[cardController::class,'cardPage'])->name('card.page');
    Route::post('/add-to-card',[cardController::class,'addTocard'])->name('add-to.card');
    Route::get('/remove-from-cart/{card_id}',[cardController::class,'removeFromCard'])->name('removeFrom.card');

    /*Authentication routes for customer/Guest*/
    Route::get('/register',[RegisterController::class,'registerPage'])->name('register.page');
    Route::post('/register',[RegisterController::class,'registerStore'])->name('register.store');
    Route::get('/login',[RegisterController::class,'loginPage'])->name('login.page');
    Route::post('/login',[RegisterController::class,'loginStore'])->name('login.store');

    Route::prefix('customer/')->middleware('auth')->group(function(){
        Route::get('dashboard',[Customercontroller::class,'dashboard'])->name('customer.dashboard');
        Route::get('logout',[RegisterController::class,'logout'])->name('customer.logout');
    });
});


/*admin auth route*/
Route::prefix('admin/')->group(function(){
    Route::get('login',[LoginController::class,'loginPage'])->name('admin.loginPage');
    Route::post('login',[LoginController::class,'login'])->name('admin.login');
    Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function(){
        Route::get('dashboard',[dashboardController::class,'dashboard'])->name('admin.dashboard');


        /*Resource Controller*/
        Route::resource('category', CategoryController::class);
        Route::resource('testimonial', TestimonialController::class);
        Route::resource('products',ProductController::class);
        Route::resource('coupon',CouponController::class);
    });

});
