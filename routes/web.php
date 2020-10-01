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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Change Language
Route::get('locale/{locale}', 'LanguageController@index')->name('language');

Auth::routes([
    'register' => false, // Registration Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('dashboard', 'DashboardController@index')->middleware('auth')->name('dashboard');

Route::group(['prefix' => 'admin' ,'middleware'=>['auth', 'admin'], 'as' => 'admin.'], function () {

    Route::get('order', 'OrderController@index')->name('order.index');
    Route::get('order/api', 'OrderController@index_api')->name('order.api');
    Route::get('order/create/new', 'OrderController@create')->name('order.create');
    Route::get('order/create/new/api', 'OrderController@create_api')->name('order.create.api');
    Route::post('order/update/{id}', 'OrderController@update')->name('order.update');
    Route::get('order/clear', 'OrderController@clear')->name('order.clear');
    Route::get('order/confirm', 'OrderController@order_confirm')->name('order.confirm');
    Route::post('order/save', 'OrderController@order_save')->name('order.save');

    // import form exel
    Route::get('product/upload', 'ProductController@upload')->name('product.upload');
    Route::post('product/import', 'ProductController@import')->name('product.import');
    Route::get('product/api', 'ProductController@index_api')->name('product.api');
    Route::resource('product', 'ProductController');

    Route::get('supplier/api', 'SupplierController@index_api')->name('supplier.api');
    Route::resource('supplier', 'SupplierController');

    Route::get('customer/api', 'CustomerController@index_api')->name('customer.api');
    Route::resource('customer', 'CustomerController');

    Route::get('brand/api', 'BrandController@index_api')->name('brand.api');
    Route::resource('brand', 'BrandController');

    Route::get('category/api', 'CategoryController@index_api')->name('category.api');
    Route::resource('category', 'CategoryController');

    Route::get('unit/api', 'UnitController@index_api')->name('unit.api');
    Route::resource('unit', 'UnitController');

    Route::get('report', 'ReportController@index')->name('report.index');

});

Route::group(['prefix' => 'customer' ,'middleware'=>['auth', 'customer'], 'as' => 'customer.'], function () {

    Route::get('order', 'OrderController@index')->name('order.index');
    Route::get('order/api', 'OrderController@index_api')->name('order.api');
    Route::get('order/create/new', 'OrderController@create')->name('order.create');
    Route::get('order/create/new/api', 'OrderController@create_api')->name('order.create.api');
    Route::post('order/update/{id}', 'OrderController@update')->name('order.update');
    Route::get('order/clear', 'OrderController@clear')->name('order.clear');
    Route::get('order/confirm', 'OrderController@order_confirm')->name('order.confirm');
    Route::post('order/save', 'OrderController@order_save')->name('order.save');
});
