<?php

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

Route::group(['namespace'=>'FrontEnd'],function(){
    Route::get('/','HomeController@index')->name('home.index');
    Route::get('add-to-cart','HomeController@create')->name('home.create');
    Route::post('show-cart','HomeController@store')->name('home.store');
    Route::get('signout','SamController@Logout')->name('logout.create');
    Route::get('vnpayreturn','CartController@VnpayReturn')->name('vnpay.return');
    Route::get('confirmation/{id}','CartController@Confrimation')->name('cart.info');
    Route::get('all-product','AllProController@index')->name('allpro.index');
    Route::get('search','AllProController@create')->name('search');


    Route::get('contact','SamController@Contact')->name('contact.index');
    Route::middleware('CheckUser')->group(function(){
        Route::resource('sign' , 'SignController');
    });
    Route::resources([
        'cart' => 'CartController',
        'blog' => 'BlogController',
    ]);
    Route::get('{id}','HomeController@show')->name('home.detail');


});


Route::group(['prefix' => 'admin','namespace'=>'BackEnd'],function(){
    Route::middleware('CheckLogin')->group(function(){
        Route::resources([
            '/' => 'DashboardController',
            'dashboard'         => 'DashboardController',
            'category'          => 'CategoryController',
            'product'           => 'ProductController',
            'gallery'           => 'GalleryController',
            'account'           => 'AccountController',
            'order'             => 'OrderController',
            'slider'            => 'SliderController',
            'blogs'             => 'BlogsController',
            'blogs-cate'        => 'BlogsCateController',
            'same'              => 'SameController',
        ]);
    });
});
