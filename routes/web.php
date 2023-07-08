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

Auth::routes();

Route::get('/', [Frontend\HomeController::class, 'index'])->name('/');
Route::get('booking', [Frontend\BookingController::class, 'index'])->name('booking');
Route::post('booking', [Frontend\BookingController::class, 'store'])->name('booking.store');
Route::get('booking/contact_details/{id}', [Frontend\BookingController::class, 'contactDetails'])->name('contact_details');
Route::post('save_contact_details', [Frontend\BookingController::class, 'contactDetailsSave'])->name('save_contact_details');
Route::get('booking/payment/{id}', [Frontend\BookingController::class, 'payment'])->name('payment');
Route::post('booking/payment', [Frontend\BookingController::class, 'paymentSave'])->name('payment.save');
Route::get('booking/payment/detail/{id}', [Frontend\BookingController::class, 'paymentDetail'])->name('payment_detail');
Route::put('booking/payment/detail/{id}', [Frontend\BookingController::class, 'paymentDetailSave'])->name('payment_detail.save');
Route::get('search', [Frontend\HomeController::class, 'search'])->name('search');

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
