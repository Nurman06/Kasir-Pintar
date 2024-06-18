<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PurchaseDetailController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');    
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/category/data', [CategoryController::class, 'data'])->name('category.data');
    Route::resource('/category', CategoryController::class);

    Route::get('/product/data', [ProductController::class, 'data'])->name('product.data');
    Route::resource('/product', ProductController::class);

    Route::get('/customer/data', [CustomerController::class, 'data'])->name('customer.data');
    Route::resource('/customer', CustomerController::class);

    Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
    Route::resource('/supplier', SupplierController::class);

    Route::get('/expenditure/data', [ExpenditureController::class, 'data'])->name('expenditure.data');
    Route::resource('/expenditure', ExpenditureController::class);

    Route::get('/purchase/data', [PurchaseController::class, 'data'])->name('purchase.data');
    Route::get('/purchase/{id}/create', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::resource('/purchase', PurchaseController::class)
        ->except('create');
    
    Route::get('/purchase_detail/{id}/data', [PurchaseDetailController::class, 'data'])->name('purchase_detail.data');
    Route::get('/purchase_detail/loadform/{discount}/{total}', [PurchaseDetailController::class, 'loadForm'])->name('purchase_detail.load_form');
    Route::resource('/purchase_detail', PurchaseDetailController::class)
        ->except('create', 'show', 'edit');

    Route::get('/sale/data', [SaleController::class, 'data'])->name('sale.data');
    Route::get('/sale/{id}/create', [SaleController::class, 'create'])->name('sale.create');
    Route::resource('/sale', SaleController::class)
        ->except('create');
    
    Route::get('/sale_detail/{id}/data', [SaleDetailController::class, 'data'])->name('sale_detail.data');
    Route::get('/sale_detail/loadform/{discount}/{total}', [SaleDetailController::class, 'loadForm'])->name('sale_detail.load_form');
    Route::resource('/sale_detail', SaleDetailController::class)
        ->except('create', 'show', 'edit');
    
    Route::resource('user', UserController::class);
    Route::get('user/data', [UserController::class, 'data'])->name('user.data');
        
    
    // Logout Route
    Route::post('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});