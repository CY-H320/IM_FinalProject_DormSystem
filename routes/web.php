<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PackageController;

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

});

Route::get('packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('packages/create', [PackageController::class, 'create'])->name('package.create');
Route::post('packages', [PackageController::class, 'store'])->name('package.store');
Route::delete('packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
