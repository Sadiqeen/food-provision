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
    return redirect()->route('admin.dashboard');
});

// Change Language
Route::get('locale/{locale}', 'LanguageController@index')->name('language');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::group(['prefix'=>'admin','middleware'=>'auth', 'as' => 'admin.'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('order', 'OrderController@index')->name('order.index');

    // import form exel
    // Route::get('product/upload', 'ProductController@upload')->name('product.upload');
    // Route::post('product/import', 'ProductController@import')->name('product.import');
    Route::get('product/api', 'ProductController@index_api')->name('product.api');
    Route::resource('product', 'ProductController');

    Route::get('supplier/api', 'SupplierController@index_api')->name('supplier.api');
    Route::resource('supplier', 'SupplierController');

    Route::get('customer/api', 'CustomerController@index_api')->name('customer.api');
    Route::resource('customer', 'CustomerController');

    Route::get('brand/api', 'BrandController@index_api')->name('brand.api');
    Route::resource('brand', 'BrandController');

    Route::get('category/api', 'CategoyController@index_api')->name('category.api');
    Route::resource('category', 'CategoyController');

    Route::get('unit/api', 'UnitController@index_api')->name('unit.api');
    Route::resource('unit', 'UnitController');

});
