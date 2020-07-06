<?php

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

Auth::routes();
//backend
Route::get('/home', 'HomeController@index')->name('home');
//middleware group
Route::group(['middleware' => 'auth'], function () {
    //manage user route
    Route::group(['prefix' => 'users'], function () {
        Route::get('/view', 'Backend\UserController@view')->name('users.view');
        Route::get('/add', 'Backend\UserController@add')->name('users.add');
        Route::post('/store', 'Backend\UserController@store')->name('users.store');
        Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
        Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
        Route::get('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');
    });
    // manage profile route
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/view', 'Backend\ProfileController@view')->name('profile.view');
        Route::get('/edit', 'Backend\ProfileController@edit')->name('profile.edit');
        Route::post('/update', 'Backend\ProfileController@update')->name('profile.update');
        Route::get('/pass/view', 'Backend\ProfileController@passview')->name('profile.pass.view');
        Route::post('/pass/change', 'Backend\ProfileController@passchange')->name('profile.pass.change');
    });
    // manage suppliers
    Route::group(['prefix' => 'suppliers'], function () {
        Route::get('/view', 'Backend\SupplierController@view')->name('suppliers.view');
        Route::get('/add', 'Backend\SupplierController@add')->name('suppliers.add');
        Route::post('/store', 'Backend\SupplierController@store')->name('suppliers.store');
        Route::get('/edit/{id}', 'Backend\SupplierController@edit')->name('suppliers.edit');
        Route::post('/update/{id}', 'Backend\SupplierController@update')->name('suppliers.update');
        Route::get('/delete/{id}', 'Backend\SupplierController@delete')->name('suppliers.delete');
    });
    //manage customers
    Route::group(['prefix' => 'customers'], function () {
        Route::get('/view', 'Backend\CustomerController@view')->name('customers.view');
        Route::get('/add', 'Backend\CustomerController@add')->name('customers.add');
        Route::post('/store', 'Backend\CustomerController@store')->name('customers.store');
        Route::get('/edit/{id}', 'Backend\CustomerController@edit')->name('customers.edit');
        Route::post('/update/{id}', 'Backend\CustomerController@update')->name('customers.update');
        Route::get('/delete/{id}', 'Backend\CustomerController@delete')->name('customers.delete');
        Route::get('/credit','Backend\CustomerController@creditCustomer')->name('customers.credit');
        Route::get('/credit/pdf','Backend\CustomerController@creditCustomerpdf')->name('customers.credi.pdf');
        Route::get('/invoice/edit/{invoice_id}', 'Backend\CustomerController@editinvoice')->name('customers.edit.invoice');
        Route::post('/invoice/update/{invoice_id}', 'Backend\CustomerController@updateinvoice')->name('customers.update.invoice');
        Route::get('/invoice/details/pdf/{invoice_id}', 'Backend\CustomerController@detailsInvoice')->name('invoice.details.pdf');
        Route::get('/paid/customer','Backend\CustomerController@paidCustomer')->name('customers.paid');
        Route::get('/paid/pdf','Backend\CustomerController@paidCustomerpdf')->name('customers.paid.pdf');
    });
    Route::group(['prefix' => 'units'], function () {
        Route::get('/view', 'Backend\UnitController@view')->name('units.view');
        Route::get('/add', 'Backend\UnitController@add')->name('units.add');
        Route::post('/store', 'Backend\UnitController@store')->name('units.store');
        Route::get('/edit/{id}', 'Backend\UnitController@edit')->name('units.edit');
        Route::post('/update/{id}', 'Backend\UnitController@update')->name('units.update');
        Route::get('/delete/{id}', 'Backend\UnitController@delete')->name('units.delete');
    });
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/view', 'Backend\CategoriesController@view')->name('categories.view');
        Route::get('/add', 'Backend\CategoriesController@add')->name('categories.add');
        Route::post('/store', 'Backend\CategoriesController@store')->name('categories.store');
        Route::get('/edit/{id}', 'Backend\CategoriesController@edit')->name('categories.edit');
        Route::post('/update/{id}', 'Backend\CategoriesController@update')->name('categories.update');
        Route::get('/delete/{id}', 'Backend\CategoriesController@delete')->name('categories.delete');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/view', 'Backend\ProductController@view')->name('products.view');
        Route::get('/add', 'Backend\ProductController@add')->name('products.add');
        Route::post('/store', 'Backend\ProductController@store')->name('products.store');
        Route::get('/edit/{id}', 'Backend\ProductController@edit')->name('products.edit');
        Route::post('/update/{id}', 'Backend\ProductController@update')->name('products.update');
        Route::get('/delete/{id}', 'Backend\ProductController@delete')->name('products.delete');
    });
    Route::group(['prefix' => 'purchase'], function () {
        Route::get('/view', 'Backend\PurchaseController@view')->name('purchase.view');
        Route::get('/add', 'Backend\PurchaseController@add')->name('purchase.add');
        Route::post('/store', 'Backend\PurchaseController@store')->name('purchase.store');
        Route::get('/pending', 'Backend\PurchaseController@PendingList')->name('pending.view.list');
        Route::get('/approve/{id}', 'Backend\PurchaseController@approve')->name('purchase.approve');
        Route::get('/delete/{id}', 'Backend\PurchaseController@delete')->name('purchase.delete');
    });
    Route::get('/get-category', 'Backend\DefaultController@getCategory')->name('get-category');
    Route::get('/get-product', 'Backend\DefaultController@getProduct')->name('get-product');
    Route::get('/get-stock', 'Backend\DefaultController@getStock')->name('check-product-stock');
    

    //manage invoice
    Route::group(['prefix' => 'invoice'], function () {
        Route::get('/view', 'Backend\InvoiceController@view')->name('invoice.view');
        Route::get('/add', 'Backend\InvoiceController@add')->name('invoice.add');
        Route::post('/store', 'Backend\InvoiceController@store')->name('invoice.store');
        Route::get('/pending', 'Backend\InvoiceController@PendingList')->name('invoice.pending.list');
        Route::get('/approve/{id}', 'Backend\InvoiceController@approve')->name('invoice.approve');
        Route::get('/delete/{id}', 'Backend\InvoiceController@delete')->name('invoice.delete');
        Route::post('/approve/store/{id}', 'Backend\InvoiceController@approval_store')->name('approval.store');
        Route::get('/delete_approve/{id}', 'Backend\InvoiceController@delete_approve')->name('invoice.approve.delete');
        Route::get('/print/{id}', 'Backend\InvoiceController@printInvoice')->name('invoice.print');
        Route::get('/daily/report', 'Backend\InvoiceController@dailyReport')->name('invoice.daily.report');
        Route::get('/daily/report/pdf', 'Backend\InvoiceController@dailyReportPdf')->name('invoice.daily.report.pdf');
    });
    //manage stock
    Route::group(['prefix' => 'stock'], function () {
        Route::get('/report', 'Backend\StockController@StockReport')->name('stock.report');
        Route::get('/report/pdf', 'Backend\StockController@StockReportpdf')->name('stock.report.pdf');

        
    });
});


