<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GRNController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\IssueInventoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecieveInventoryController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\UnitMeasurementController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VoucherController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::middleware(['auth'])->group(function() {
    Route::resource('users', UserController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('measurements', UnitMeasurementController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('products', ProductController::class);
    Route::resource('product-categories', ProductCategoryController::class);
    Route::resource('grn', GRNController::class);
    Route::resource('issue-inventories', IssueInventoryController::class);
    Route::resource('recieve-inventories', RecieveInventoryController::class);
    Route::get('reports/product', [RecieveInventoryController::class, 'monthlyReportProduct'])->name('reports.product');
    Route::get('reports/issue/product', [IssueInventoryController::class, 'monthlyReportProduct'])->name('reports.issue.product');
    Route::get('reports/supplier', [RecieveInventoryController::class, 'monthlyReportSupplier'])->name('reports.supplier');
// });


Route::resource('academic-years', AcademicYearController::class);
Route::resource('classes', ClassController::class);
Route::resource('sections', SectionController::class);
Route::resource('schools', SchoolController::class);
Route::resource('students', StudentController::class);
Route::resource('profiles', ProfileController::class);
Route::resource('vouchers', VoucherController::class);
Route::resource('expenses', ExpenseController::class);
Route::post('students/import', [StudentController::class, 'import'])->name('students.import');
Route::resource('teachers', TeacherController::class);
Route::post('teachers/import', [TeacherController::class, 'import'])->name('teachers.import');

Route::controller(SettingController::class)->prefix('settings')->name('settings.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/', 'show')->name('show');
    Route::get('/edit', 'edit')->name('edit');
    Route::put('/{industry}', 'update')->name('update');
});
