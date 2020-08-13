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

Route::group(['prefix'=>'admin','middleware'=>'auth', 'as' => 'admin.'], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // Supplier controll

    Route::get('supplier', 'SupplierController@index')->name('supplier.index');         // Get data
    Route::get('supplier/api', 'SupplierController@index_api')->name('supplier.api');         // Get data
    Route::get('supplier/{id}', 'SupplierController@show')->name('supplier.show');      // Get specific data

    Route::get('supplier/create', 'SupplierController@create')->name('supplier.create');    // Create data
    Route::POST('supplier', 'SupplierController@store')->name('supplier.store');            // Create data

    Route::get('supplier/{id}/edit', 'SupplierController@edit')->name('supplier.edit');     // Update data
    Route::PUT('supplier/{id}', 'SupplierController@update')->name('supplier.update');      // Update data

    Route::DELETE('supplier/{id}', 'SupplierController@destroy')->name('supplier.destroy'); // Delete data
});

