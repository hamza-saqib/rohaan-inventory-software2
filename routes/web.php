<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GRNController;
use App\Http\Controllers\IssueInventoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecieveInventoryController;
use App\Http\Controllers\UnitMeasurementController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\EnsureUserLogedIn;
use Illuminate\Support\Facades\Auth;
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
//     return route('home');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(EnsureUserLogedIn::class);

Route::middleware(EnsureUserLogedIn::class)->group(function() {
    Route::resource('users', UserController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('measurements', UnitMeasurementController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('products', ProductController::class);
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('grn', GRNController::class);
    Route::resource('issue-inventories', IssueInventoryController::class);
    Route::resource('recieve-inventories', RecieveInventoryController::class);
    Route::get('reports/receipt/product', [RecieveInventoryController::class, 'monthlyReportProduct'])->name('reports.product');
    Route::get('reports/issue/product', [IssueInventoryController::class, 'monthlyReportProduct'])->name('reports.issue.product');
    Route::get('reports/receipt/supplier', [RecieveInventoryController::class, 'monthlyReportSupplier'])->name('reports.supplier');
    Route::get('reports/products/ledger', [ProductController::class, 'ledger'])->name('reports.products.ledger');
    Route::get('reports/products/negative-balance', [ProductController::class, 'negativeBalance'])->name('reports.products.negative');
    Route::get('reports/issue/voucher/{isno}', [IssueInventoryController::class, 'voucher'])->name('issue-inventories.voucher');
    Route::get('reports/issue/voucher-pdf/{isno}', [IssueInventoryController::class, 'voucherPrint'])->name('issue-inventories.voucher.print');
    Route::get('reports/issue/category', [IssueInventoryController::class, 'categoryWiseReprt'])->name('reports.issue-inventories.category');
    Route::get('reports/receipt/category', [RecieveInventoryController::class, 'categoryWiseReprt'])->name('reports.recieve-inventories.category');
    Route::get('reports/receipt/supplierwise', [RecieveInventoryController::class, 'supplierWiseReprt'])->name('reports.recieve-inventories.supplier');
});
