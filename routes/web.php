<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\NpkController;
use App\Http\Controllers\PenyiramanController;
use App\Http\Controllers\PhTanahController;
use App\Http\Controllers\HasilProduksiController;
use App\Http\Controllers\PemupukanController;

use App\Http\Controllers\PetaniController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Response;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Auth;
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

// Index Routes

Route::get('/', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
});

route::get('/product/all',[ProductController::class,'productIndex'])->name('productIndex');
route::get('product/cari',[ProductController::class,'search'])->name('product.search');



// Dashboard Routes

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::group(['middleware'=>'auth'], function(){

    // User Routes
    route::get('user/profile/{user}',[UserController::class,'profile']);
    route::get('user/setting/{user}',[UserController::class,'setting']);
    route::post('user/update/{user}',[UserController::class,'settingUpdate'])->name('user.update');
    route::post('user/delete/{user}',[UserController::class,'deleteUser'])->name('user.delete');

    // Petani Routes
    route::resource('/petani',PetaniController::class)->middleware('isadmin');

    Route::group(['middleware'=>'ispetani'], function(){

        // Lahan Routes
        route::resource('/npk',NpkController::class);
        route::resource('/phtanah',PhTanahController::class);
        route::resource('/penyiraman',PenyiramanController::class);
        route::resource('/pemupukan',PemupukanController::class);
        route::resource('/hasilproduksi',HasilProduksiController::class);
    
    });
    
    Route::group(['middleware'=>'ispembeli'], function(){
        // Cart Routes
        route::resource('/cart',CartController::class);
    });
    
});
// Product Routes
route::resource('/product',ProductController::class);
route::get('product/dashboard/search',[ProductController::class,'searchDashboard'])->name('product.search.dashboard');



