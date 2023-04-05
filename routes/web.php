<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\dashboardController;
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


Route::get('/', function () {
    return view('frontend.pages.home');
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
    });

});
