<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/user/profile', [\App\Http\Controllers\User\UserController::class, 'show'])->name('user.show');
Route::get('/user/profile/edit', [\App\Http\Controllers\User\UserController::class, 'edit'])->name('profile.edit');
Route::get('/changePassword', [\App\Http\Controllers\User\UserController::class, 'changePassword'])->name('password.change');
Route::put('', [\App\Http\Controllers\User\UserController::class, 'update'])->name('profile.update');
Route::put('/updatePassword', [\App\Http\Controllers\User\UserController::class, 'updatePassword'])->name('user.password.update');

Route::middleware('auth')->group(function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/create', [\App\Http\Controllers\Backend\StudentController::class, 'create'])->name('student.create');
    Route::post('', [\App\Http\Controllers\Backend\StudentController::class, 'store'])->name('student.store');
    Route::get('/index',[\App\Http\Controllers\Backend\StudentController::class,'index'])->name('student.index');
    Route::get('/show/{id}',[\App\Http\Controllers\Backend\StudentController::class, 'show'])->name('student.show');
    Route::get('/edit/{id}', [\App\Http\Controllers\Backend\StudentController::class, 'edit'])->name('student.edit');
    Route::put('/update/{id}',[\App\Http\Controllers\Backend\StudentController::class, 'update'])->name('student.update');
    Route::delete('/destroy/{id}', [\App\Http\Controllers\Backend\StudentController::class, 'destroy'])->name('student.destroy');
});

