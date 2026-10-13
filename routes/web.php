<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClothingOrderController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class,'index'])->name('dashboard');
Route::resource('customers', CustomerController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('orders', ClothingOrderController::class);
Route::resource('measurements', MeasurementController::class);
Route::resource('payments', PaymentController::class);
