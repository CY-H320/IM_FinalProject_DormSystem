<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('index');
});

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');;

Route::middleware(['auth'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('students/{id}', [StudentController::class, 'showDetails'])->name('student.details');
    Route::delete('packages/{id}', [StudentController::class, 'deletePackage'])->name('package.delete');
    Route::get('packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('packages/create', [PackageController::class, 'create'])->name('package.create');
    Route::post('packages', [PackageController::class, 'store'])->name('package.store');
    Route::delete('packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
    Route::resource('visitors', VisitorController::class);
    Route::get('visitors', [VisitorController::class, 'index'])->name('visitors.index');
    Route::get('visitors/create', [VisitorController::class, 'create'])->name('visitors.create');
    Route::post('visitors', [VisitorController::class, 'store'])->name('visitors.store');
    Route::delete('visitors/{visitor}', [VisitorController::class, 'destroy'])->name('visitors.destroy');
    Route::get('/equipments', [BookingController::class, 'index'])->name('equipments.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

Route::get('packages/public', [PackageController::class, 'public'])->name('package.public');
Route::get('visitors/public/create', [VisitorController::class, 'publicCreate'])->name('visitors.publicCreate');
Route::post('visitors/public/create', [VisitorController::class, 'publicStore'])->name('visitors.publicStore');




