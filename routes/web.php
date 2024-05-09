<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DaftarTransaksiController;
use App\Http\Controllers\NpkController;
use App\Http\Controllers\PenyiramanController;
use App\Http\Controllers\PhTanahController;
use App\Http\Controllers\HasilProduksiController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\PemupukanController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', [IndexController::class,'index']);
Route::get('/index', [IndexController::class,'index']);

route::get('index/cari',[ProductController::class,'search'])->name('product.search');



// Dashboard Routes

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes(['verify' => true]);

Route::group(['middleware'=>['auth','verified']], function(){

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
        route::get('cart/petani/{nama}',[CartController::class,'cartPetani']);
        route::get('/checkout/cart/{nama}',[CartController::class,'checkout']);
        route::get('/riwayat-transaksi',[DaftarTransaksiController::class,'riwayatTransaksi']);
        route::resource('/cart',CartController::class);
        route::post('/after-payment',[DaftarTransaksiController::class,'afterPayment']);


        // Ongkir routes
        route::get('/ongkir',[OngkirController::class,'index']);
        route::get('/cities/{id}',[OngkirController::class,'getCities']);
        route::post('/ongkir',[OngkirController::class,'check_ongkir']);

    });
    
});
// Product Routes
route::resource('/product',ProductController::class);
route::get('product/dashboard/search',[ProductController::class,'searchDashboard'])->name('product.search.dashboard');
route::resource('/payment',DaftarTransaksiController::class);


