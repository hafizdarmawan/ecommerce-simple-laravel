<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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


Route::get('/', 'HomeController@index')->name('home');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');
Route::get('/details/{id}','DetailController@index')->name('detail');
Route::post('/details/{id}','DetailController@add')->name('detail-add');

Route::get('/cart','CartController@index')->name('cart');



Route::get('/checkout/callback','CheckoutController@callback')->name('checkout-callback');

Route::get('/success','CartController@success')->name('success');


Route::get('/register/success','Auth\RegisterController@success')->name('register-success');




Route::group(['middleware' => ['auth']], function (){

    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::get('/dashboard/products','DashboardProductController@index')
    ->name('dashboard-product');
    Route::get('/dashboard/products/add','DashboardProductController@add')->name('dashboard-product-add');
    Route::post('/dashboard/products','DashboardProductController@store')->name('dashboard-product-store');
    Route::get('/dashboard/products/edit/(id)','DashboardProductController@edit')->name('dashboard-product-edit');
    
    Route::get('/dashboard/products/{id}','DashboardProductController@detail')
    ->name('dashboard-product-detail');
    Route::put('/dashboard/products/{id}','DashboardProductController@update')
    ->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload','DashboardProductController@uploadGallery')
    ->name('dashboard-product-gallery-upload');

    Route::delete('/dashboard/products/gallery/delete/{id}','DashboardProductController@deleteGallery')
        ->name('dashboard-product-gallery-delete');


    Route::get('/dashboard/transaction','DashboardTransactionController@index')->name('dashboard-transaction');
    Route::get('/dashboard/transaction/{id}','DashboardTransactionController@detail')->name('dashboard-transaction-detail');
    Route::put('/dashboard/transaction/{id}','DashboardTransactionController@update')->name('dashboard-transaction-update');
    
    Route::get('/dashboard/setting','DashboardSettingController@store')->name('dashboard-store');

    Route::get('/dashboard/account','DashboardSettingController@account')->name('dashboard-account');
  
    Route::put('/dashboard/account/{redirect}','DashboardSettingController@update')->name('dashboard-settings-redirect');



    Route::delete('/cart/{id}','CartController@delete')->name('cart-delete');
    
    Route::post('/checkout','CheckoutController@process')->name('checkout');
});


// middleware(['auth','admin']);
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])
    ->group(function(){
        Route::get('/','DashboardController@index')->name('admin-dashboard');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
    });

// Route::get('/dashboard/admin','Admin\DashboardController@index')->name('dashboard-admin');



Auth::routes();


