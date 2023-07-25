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
    Route::resources([
        'account' => App\Http\Controllers\Frontend\ProfileController::class,
        'changepassword' => App\Http\Controllers\Frontend\ChangePasswordController::class,
    ]);
    Route::post('rating', [Frontend\RatingController::class, 'store'])->name('rating');
});

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
    Route::post('booking_validated', [Backend\BookingController::class, 'validated'])->name('booking_validated');
    Route::post('booking_rejected', [Backend\BookingController::class, 'rejected'])->name('booking_rejected');
    Route::get('reports', [App\Http\Controllers\Backend\ReportController::class, 'index'])->name('reports');
    Route::get('reports/data', [App\Http\Controllers\Backend\ReportController::class, 'data'])->name('reports.data');
    Route::get('ratings/question1', [App\Http\Controllers\Backend\RatingController::class, 'question1'])->name('ratings.question1');
    Route::get('ratings/question2', [App\Http\Controllers\Backend\RatingController::class, 'question2'])->name('ratings.question2');
    Route::get('ratings/question3', [App\Http\Controllers\Backend\RatingController::class, 'question3'])->name('ratings.question3');
    Route::get('ratings/question4', [App\Http\Controllers\Backend\RatingController::class, 'question4'])->name('ratings.question4');
    Route::get('ratings/question5', [App\Http\Controllers\Backend\RatingController::class, 'question5'])->name('ratings.question5');
    Route::get('ratings/question6', [App\Http\Controllers\Backend\RatingController::class, 'question6'])->name('ratings.question6');
    Route::get('ratings/question7', [App\Http\Controllers\Backend\RatingController::class, 'question7'])->name('ratings.question7');Route::get('ratings/question1', [App\Http\Controllers\Backend\RatingController::class, 'question1'])->name('ratings.question1');
    Route::get('ratings/question8', [App\Http\Controllers\Backend\RatingController::class, 'question8'])->name('ratings.question8');
    Route::get('ratings/question9', [App\Http\Controllers\Backend\RatingController::class, 'question9'])->name('ratings.question9');
    Route::get('ratings/question10', [App\Http\Controllers\Backend\RatingController::class, 'question10'])->name('ratings.question10');
    Route::get('ratings/question11', [App\Http\Controllers\Backend\RatingController::class, 'question11'])->name('ratings.question11');
    Route::get('ratings/question12', [App\Http\Controllers\Backend\RatingController::class, 'question12'])->name('ratings.question12');
    Route::get('ratings/question13', [App\Http\Controllers\Backend\RatingController::class, 'question13'])->name('ratings.question13');
    Route::get('ratings/question14', [App\Http\Controllers\Backend\RatingController::class, 'question14'])->name('ratings.question14');
    Route::get('ratings/question15', [App\Http\Controllers\Backend\RatingController::class, 'question15'])->name('ratings.question15');
});
