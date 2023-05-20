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
});
