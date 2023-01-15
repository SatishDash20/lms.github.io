<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [CustomAuthController::class, 'index'])->name('login');
Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('supervisor-dashboard', [CustomAuthController::class, 'supervisordashboard']);
Route::get('employee-dashboard', [CustomAuthController::class, 'employeedashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::resource('users', UserController::class);
Route::resource('leaves', LeaveController::class);
Route::get('leave/accept/{leave_id}', [CustomAuthController::class, 'acceptleave'])->name('acceptleave');
Route::get('leave/decline/{leave_id}', [CustomAuthController::class, 'declineleave'])->name('acceptleave');
Route::get('applyleave', [CustomAuthController::class, 'applyleave']);
Route::post('applyleave', [CustomAuthController::class, 'saveapplyleave']);
