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

    Route::get('order/{id}/update', 'Admin\OrderController@order_update_status')->name('order.update.status');
    Route::post('order/{id}/update', 'Admin\OrderController@order_update_status_confirm')->name('order.update.status');
    Route::get('order/{id}/cancel', 'Admin\OrderController@order_cancel')->name('order.cancel');

    Route::get('order/{id}/call/{doc}', 'Admin\OrderController@call_to_endpoint')->name('order.call');

    Route::get('setting', 'Admin\SettingController@edit')->name('setting.edit');
    Route::put('setting/company', 'Admin\SettingController@update_setting')->name('setting.update.setting');
    Route::put('setting/profile', 'Admin\SettingController@update_profile')->name('setting.update.profile');

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

    Route::get('order', 'Customer\OrderController@index')->name('order.index');
    Route::get('order/api', 'Customer\OrderController@index_api')->name('order.api');
    Route::get('order/create', 'Customer\OrderController@create')->name('order.create');
    Route::post('order/add/{id}', 'Customer\OrderController@add_item')->name('order.add.item');
    Route::post('order/update/{id}', 'Customer\OrderController@update_item')->name('order.update.item');
    Route::post('order/update_api/{id}', 'Customer\OrderController@update')->name('order.update');
    Route::get('order/delete/{id}', 'Customer\OrderController@delete_item')->name('order.delete');
    Route::get('order/cart', 'Customer\OrderController@cart')->name('order.cart');
    Route::post('order/save', 'Customer\OrderController@order_save')->name('order.save');

    Route::get('order/{id}/update', 'Customer\OrderController@order_update_status')->name('order.update.status');
    Route::get('order/{id}/cancel', 'Customer\OrderController@order_cancel')->name('order.cancel');

    Route::get('order/{id}/call/{doc}', 'Customer\OrderController@call_to_endpoint')->name('order.call');

    Route::get('employee/api', 'Customer\EmployeeController@index_api')->name('employee.api');
    Route::resource('employee', 'Customer\EmployeeController');

    Route::get('profile', 'Customer\ProfileController@edit')->name('profile.edit');
    Route::put('profile', 'Customer\ProfileController@update')->name('profile.update');
});

Route::group(['prefix' => 'employee' ,'middleware'=>['auth', 'employee'], 'as' => 'employee.'], function () {

    Route::get('order', 'Employee\OrderController@index')->name('order.index');
    Route::get('order/api', 'Employee\OrderController@index_api')->name('order.api');
    Route::get('order/create', 'Employee\OrderController@create')->name('order.create');
    Route::post('order/add/{id}', 'Employee\OrderController@add_item')->name('order.add.item');
    Route::post('order/update/{id}', 'Employee\OrderController@update_item')->name('order.update.item');
    Route::post('order/update_api/{id}', 'Employee\OrderController@update')->name('order.update');
    Route::get('order/delete/{id}', 'Employee\OrderController@delete_item')->name('order.delete');
    Route::get('order/cart', 'Employee\OrderController@cart')->name('order.cart');
    Route::post('order/save', 'Employee\OrderController@order_save')->name('order.save');
    Route::get('order/{id}/update', 'Employee\OrderController@order_update_status')->name('order.update.status');
    Route::get('order/{id}/cancel', 'Employee\OrderController@order_cancel')->name('order.cancel');

    Route::get('order/{id}/call/{doc}', 'Employee\OrderController@call_to_endpoint')->name('order.call');

    Route::get('profile', 'Employee\ProfileController@edit')->name('profile.edit');
    Route::put('profile', 'Employee\ProfileController@update')->name('profile.update');

});
