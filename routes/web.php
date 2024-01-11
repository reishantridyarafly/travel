<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend;
use App\Http\Controllers\Frontend;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/send', [HomeController::class, 'send'])->name('send');
Route::get('/tampil', [HomeController::class, 'tampil'])->name('tampil');


Auth::routes();

Route::get('/', [Frontend\HomeController::class, 'index'])->name('/');
Route::get('booking-langkuy', [Frontend\BookingController::class, 'index'])->name('booking_langkuy');
Route::get('search', [Frontend\HomeController::class, 'search'])->name('search');
Route::get('detail/{slug}', [Frontend\HomeController::class, 'show'])->name('detail');

Route::middleware(['role:user'])->group(function () {
    Route::post('booking', [Frontend\BookingController::class, 'store'])->name('booking.store');
    Route::put('booking/cancel/{id}', [Frontend\BookingController::class, 'cancel'])->name('booking.cancel');
    Route::get('booking/contact_details/{id}', [Frontend\BookingController::class, 'contactDetails'])->name('contact_details');
    Route::post('save_contact_details', [Frontend\BookingController::class, 'contactDetailsSave'])->name('save_contact_details');
    Route::get('booking/payment/{id}', [Frontend\BookingController::class, 'payment'])->name('payment');
    Route::post('booking/payment', [Frontend\BookingController::class, 'paymentSave'])->name('payment.save');
    Route::post('booking/payment/cancel', [Frontend\BookingController::class, 'paymentCancel'])->name('payment.cancel');
    Route::get('booking/payment/detail/{id}', [Frontend\BookingController::class, 'paymentDetail'])->name('payment_detail');
    Route::put('booking/payment/detail/{id}', [Frontend\BookingController::class, 'paymentDetailSave'])->name('payment_detail.save');
    Route::put('booking/payment/detail/cancel/{id}', [Frontend\BookingController::class, 'paymentDetailCancel'])->name('payment_detail.cancel');
    Route::get('histories', [App\Http\Controllers\Frontend\HistoryController::class, 'index'])->name('histories');
    Route::get('histories/print/{id}', [App\Http\Controllers\Frontend\HistoryController::class, 'print'])->name('histories.print');
    Route::resources([
        'account' => App\Http\Controllers\Frontend\ProfileController::class,
        'changepassword' => App\Http\Controllers\Frontend\ChangePasswordController::class,
    ]);
    Route::post('rating', [Frontend\RatingController::class, 'store'])->name('rating');
});

Route::middleware(['role:admin'])->group(function () {
    Route::get('dashboard', [Backend\DashboardController::class, 'index'])->name('dashboard');

    Route::resources([
        'packages' => Backend\PackageController::class,
        'customers' => Backend\CustomerController::class,
        'payments' => Backend\PaymentController::class,
        'profile' => Backend\ProfileController::class,
        'change-password' => Backend\ChangePasswordController::class,
    ]);

    Route::get('booking', [Backend\BookingController::class, 'index'])->name('booking.index');
    Route::post('booking_validated', [Backend\BookingController::class, 'validated'])->name('booking_validated');
    Route::post('booking_rejected', [Backend\BookingController::class, 'rejected'])->name('booking_rejected');
    Route::post('booking_finish', [Backend\BookingController::class, 'finish'])->name('booking_finish');

    Route::get('reports', [App\Http\Controllers\Backend\ReportController::class, 'index'])->name('reports');
    Route::get('reports/data', [App\Http\Controllers\Backend\ReportController::class, 'data'])->name('reports.data');

    Route::get('ratings', [App\Http\Controllers\Backend\RatingController::class, 'index'])->name('ratings.index');
});

Route::middleware(['role:admin|owner'])->group(function () {
    Route::get('dashboard', [Backend\DashboardController::class, 'index'])->name('dashboard');

    Route::resources([
        'profile' => Backend\ProfileController::class,
        'change-password' => Backend\ChangePasswordController::class,
    ]);

    Route::get('reports', [App\Http\Controllers\Backend\ReportController::class, 'index'])->name('reports');
    Route::get('reports/data', [App\Http\Controllers\Backend\ReportController::class, 'data'])->name('reports.data');

    Route::get('ratings', [App\Http\Controllers\Backend\RatingController::class, 'index'])->name('ratings.index');
});
