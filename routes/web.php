<?php

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

use App\Http\Controllers\MotorController;
use App\Http\Controllers\Admin\AdminMotorController;

Route::get('/', [MotorController::class, 'index'])->name('home');
Route::get('/motors', [MotorController::class, 'list'])->name('motors.list');
Route::get('/details/{id}', [MotorController::class, 'show'])->name('motors.details');
Route::get('/order/{id}', [MotorController::class, 'order'])->middleware(['auth'])->name('motors.order');
Route::get('/payment/{id}', [MotorController::class, 'payment'])->middleware(['auth'])->name('motors.payment');
Route::post('/rent/{id}', [MotorController::class, 'rent'])->middleware(['auth'])->name('motors.rent');
Route::get('/profile', [MotorController::class, 'profile'])->middleware(['auth'])->name('profile');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminMotorController::class, 'index'])->name('admin.dashboard');
    Route::post('/motors/store', [AdminMotorController::class, 'store'])->name('admin.motors.store');
    Route::post('/motors/{id}/toggle', [AdminMotorController::class, 'toggleStatus'])->name('admin.motors.toggle');
});

require __DIR__.'/auth.php';
