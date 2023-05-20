<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend;
use App\Http\Controllers\Frontend;

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

Route::get('/', [Frontend\HomeController::class, 'index'])->name('/');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['role:owner|admin'])->group(function () {
    Route::get('dashboard', [Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        'packages' => Backend\PackageController::class,
        'customers' => Backend\CustomerController::class,
        'payments' => Backend\PaymentController::class,
        'profile' => Backend\ProfileController::class,
        'change-password' => Backend\ChangePasswordController::class,
    ]);
    Route::get('booking_pending', [Backend\BookingController::class, 'pending'])->name('booking_pending');
    Route::get('booking_success', [Backend\BookingController::class, 'success'])->name('booking_success');
    Route::get('booking_failed', [Backend\BookingController::class, 'failed'])->name('booking_failed');
    Route::get('transaction_pending', [Backend\TransactionController::class, 'pending'])->name('transaction_pending');
    Route::get('transaction_success', [Backend\TransactionController::class, 'success'])->name('transaction_success');
    Route::get('transaction_failed', [Backend\TransactionController::class, 'failed'])->name('transaction_failed');
    Route::post('transaction_validated', [Backend\TransactionController::class, 'validated'])->name('transaction_validated');
    Route::post('transaction_rejected', [Backend\TransactionController::class, 'rejected'])->name('transaction_rejected');
    Route::get('reports', [App\Http\Controllers\Backend\ReportController::class, 'index'])->name('reports');
    Route::get('reports/data', [App\Http\Controllers\Backend\ReportController::class, 'data'])->name('reports.data');
});
