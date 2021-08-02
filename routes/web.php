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
    return view('welcome');
});
Route::get('/bank_details',[App\Http\Controllers\bankController::class, 'show'])->name('bank');
Route::get('/company_details',[App\Http\Controllers\companyController::class, 'show'])->name('company');
Route::get('/customer_details',[App\Http\Controllers\customerController::class, 'show'])->name('customer');
Route::get('/financial_year',[App\Http\Controllers\financeController::class, 'show'])->name('year');
Route::get('/hsn_master',[App\Http\Controllers\hsnController::class, 'show'])->name('hsn');
Route::get('/product_category',[App\Http\Controllers\categoryController::class, 'show'])->name('category');
Route::get('/role',[App\Http\Controllers\roleController::class, 'show'])->name('role');
Route::get('/tax',[App\Http\Controllers\taxController::class, 'show'])->name('tax');
Route::get('/product',[App\Http\Controllers\productController::class, 'show'])->name('product');
Route::get('/sales_invoice',[App\Http\Controllers\SalesController::class, 'show'])->name('sales');
Route::get('/sales_invoice_product',[App\Http\Controllers\invoice_productController::class, 'show'])->name('invoice');



Route::post('/addbank','App\Http\Controllers\bankController@store');
Route::get('/getBank','App\Http\Controllers\bankController@index');
Route::post('/getBankById','App\Http\Controllers\bankController@edit');
Route::post('/updatebank','App\Http\Controllers\bankController@update');
Route::post('/deleteBankById','App\Http\Controllers\bankController@destroy');
Route::post('/addcompany','App\Http\Controllers\companyController@store');
Route::get('/getCompany','App\Http\Controllers\companyController@index');
Route::post('/getCompanyById','App\Http\Controllers\companyController@edit');
Route::post('/updatecompany','App\Http\Controllers\companyController@update');
Route::post('/deleteCompanyById','App\Http\Controllers\companyController@destroy');
Route::post('/addcustomer','App\Http\Controllers\customerController@store');
Route::get('/getCustomer','App\Http\Controllers\customerController@index');
Route::post('/getCustomerById','App\Http\Controllers\customerController@edit');
Route::post('/updatecustomer','App\Http\Controllers\customerController@update');
Route::post('/deletecustomerById','App\Http\Controllers\customerController@destroy');
Route::post('/addyear','App\Http\Controllers\financeController@store');
Route::get('/getyear','App\Http\Controllers\financeController@index');
Route::post('/getyearById','App\Http\Controllers\financeController@edit');
Route::post('/updateyear','App\Http\Controllers\financeController@update');
Route::post('/deleteyearById','App\Http\Controllers\financeController@destroy');
Route::post('/addhsn','App\Http\Controllers\hsnController@store');
Route::get('/gethsn','App\Http\Controllers\hsnController@index');
Route::post('/gethsnById','App\Http\Controllers\hsnController@edit');
Route::post('/updatehsn','App\Http\Controllers\hsnController@update');
Route::post('/deletehsnById','App\Http\Controllers\hsnController@destroy');
Route::post('/addcat',[App\Http\Controllers\categoryController::class, 'store']);
Route::get('/getcat',[App\Http\Controllers\categoryController::class, 'index']);
Route::post('/getcatById',[App\Http\Controllers\categoryController::class, 'edit']);
Route::post('/updatecat',[App\Http\Controllers\categoryController::class, 'update']);
Route::post('/deletecatById',[App\Http\Controllers\categoryController::class, 'destroy']);
Route::post('/addrole',[App\Http\Controllers\roleController::class, 'store']);
Route::get('/getrole',[App\Http\Controllers\roleController::class, 'index']);
Route::post('/getroleById',[App\Http\Controllers\roleController::class, 'edit']);
Route::post('/updaterole',[App\Http\Controllers\roleController::class, 'update']);
Route::post('/deleteroleById',[App\Http\Controllers\roleController::class, 'destroy']);
Route::post('/addtax',[App\Http\Controllers\taxController::class, 'store']);
Route::get('/gettax',[App\Http\Controllers\taxController::class, 'index']);
Route::post('/gettaxById',[App\Http\Controllers\taxController::class, 'edit']);
Route::post('/updatetax',[App\Http\Controllers\taxController::class, 'update']);
Route::post('/addproduct',[App\Http\Controllers\productController::class, 'store']);
Route::get('/getproduct',[App\Http\Controllers\productController::class, 'index']);
Route::post('/getproductById',[App\Http\Controllers\productController::class, 'edit']);
Route::post('/updateproduct',[App\Http\Controllers\productController::class, 'update']);
Route::post('/deleteproductById',[App\Http\Controllers\productController::class, 'destroy']);
Route::post('/addsales',[App\Http\Controllers\SalesController::class, 'store']);
Route::get('/getsales',[App\Http\Controllers\SalesController::class, 'index']);
Route::post('/getsalesById',[App\Http\Controllers\SalesController::class, 'edit']);
Route::post('/updatesales',[App\Http\Controllers\SalesController::class, 'update']);
Route::post('/deletesalesById',[App\Http\Controllers\SalesController::class, 'destroy']);
Route::post('/addinvoice',[App\Http\Controllers\invoice_productController::class, 'store']);
Route::get('/getinvoice',[App\Http\Controllers\invoice_productController::class, 'index']);
Route::post('/getinvoiceById',[App\Http\Controllers\invoice_productController::class, 'edit']);
Route::post('/updateinvoice',[App\Http\Controllers\invoice_productController::class, 'update']);
Route::post('/deleteinvoiceById',[App\Http\Controllers\invoice_productController::class, 'destroy']);


// Route::get('/products','App\Http\Controllers\productController@index');
// Route::get('/role','App\Http\Controllers\roleController@index');
// Route::get('/tax','App\Http\Controllers\taxController@index');
// Route::get('/sales_invoice_product','App\Http\Controllers\invoice_productController@index');









Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
