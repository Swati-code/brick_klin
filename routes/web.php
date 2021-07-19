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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('sales_invoice');
});

Route::get('/customer_details','App\Http\Controllers\customerController@index');
Route::get('/bank_details','App\Http\Controllers\bankController@index');
Route::get('/company_details','App\Http\Controllers\companyController@index');
Route::get('/product_category','App\Http\Controllers\categoryController@index');
Route::get('/financial_year','App\Http\Controllers\financeController@index');
Route::get('/hsn_master','App\Http\Controllers\hsnController@index');
Route::get('/products','App\Http\Controllers\productController@index');
Route::get('/role','App\Http\Controllers\roleController@index');
Route::get('/tax','App\Http\Controllers\taxController@index');
Route::get('/sales_invoice_product','App\Http\Controllers\invoice_productController@index');








