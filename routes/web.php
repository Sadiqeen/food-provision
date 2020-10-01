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

    Route::get('order', 'Admin\OrderController@index')->name('order.index');
    Route::get('order/api', 'Admin\OrderController@index_api')->name('order.api');
    Route::get('order/create/new', 'Admin\OrderController@create')->name('order.create');
    Route::get('order/create/new/api', 'Admin\OrderController@create_api')->name('order.create.api');
    Route::post('order/update/{id}', 'Admin\OrderController@update')->name('order.update');
    Route::get('order/clear', 'Admin\OrderController@clear')->name('order.clear');
    Route::get('order/confirm', 'Admin\OrderController@order_confirm')->name('order.confirm');
    Route::post('order/save', 'Admin\OrderController@order_save')->name('order.save');

    // import form exel
    Route::get('product/upload', 'Admin\ProductController@upload')->name('product.upload');
    Route::post('product/import', 'Admin\ProductController@import')->name('product.import');
    Route::get('product/api', 'Admin\ProductController@index_api')->name('product.api');
    Route::resource('product', 'Admin\ProductController');

    Route::get('supplier/api', 'Admin\SupplierController@index_api')->name('supplier.api');
    Route::resource('supplier', 'Admin\SupplierController');

    Route::get('customer/api', 'Admin\CustomerController@index_api')->name('customer.api');
    Route::resource('customer', 'Admin\CustomerController');

    Route::get('brand/api', 'Admin\BrandController@index_api')->name('brand.api');
    Route::resource('brand', 'Admin\BrandController');

    Route::get('category/api', 'Admin\CategoryController@index_api')->name('category.api');
    Route::resource('category', 'Admin\CategoryController');

    Route::get('unit/api', 'Admin\UnitController@index_api')->name('unit.api');
    Route::resource('unit', 'Admin\UnitController');

    Route::get('report', 'Admin\ReportController@index')->name('report.index');

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
