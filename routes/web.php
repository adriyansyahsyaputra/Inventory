<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ActivityLogController;

Route::get('/', function () {
    return view('dashboard', [
        'title' => 'Dashboard'
    ]);
})->middleware('auth');

// Route Create
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Route Delete Table
Route::get('/products', [ProductController::class, 'index'])->name('products.table');
Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('products.delete');

// Route Update
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::get('/products/update', function () {
    return view('/products/update');
});


// Route For User
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Route Delete For User
Route::get('/users', [UserController::class, 'index'])->name('users.table');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Route Update For User
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');


// Route For Log activity
Route::middleware('auth')->group(function () {
    Route::get('/log-activity', [ActivityLogController::class, 'index'])->name('logs.index');
    Route::post('/log-activity', [ActivityLogController::class, 'storeLog'])->name('logs.store');
});


// Route For Login
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Route For Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');