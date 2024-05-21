<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\BookingController;
// use App\Http\Controllers\ScriptController;

Route::get('/', function () {
    return view('index');
});

Route::get('login', [LoginController::class, 'show'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');;

Route::middleware(['auth'])->group(function () {
    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('students/{id}', [StudentController::class, 'showDetails'])->name('student.details');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('student.update');
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
    Route::post('/bookings/clean', [BookingController::class, 'clean'])->name('bookings.clean');

});

Route::get('packages/public', [PackageController::class, 'public'])->name('package.public');
Route::get('equipments/public', [BookingController::class, 'public'])->name('equipments.public');
Route::get('visitors/public/create', [VisitorController::class, 'publicCreate'])->name('visitors.publicCreate');
Route::post('visitors/public/create', [VisitorController::class, 'publicStore'])->name('visitors.publicStore');




// Route::post('/', [ScriptController::class, 'run']);