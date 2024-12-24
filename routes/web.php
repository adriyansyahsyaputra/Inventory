<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('dashboard', [
        'title' => 'Dashboard'
    ]);
});

// Route Create
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Route Delete Table
Route::get('/products', [ProductController::class, 'index'])->name('products.table');
Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('products.delete');

// Route Update
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

Route::get('/products/update', function() {
    return view('/products/update');
});


// Route For User
Route::get('/users/create', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Route Delete For User
Route::get('/users', [UserController::class, 'index'])->name('users.table');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Route Update For User
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

Route::get('/users/table-user', function () {
    return view('/users/table', [
        'title' => 'Table User',
        'users' => User::all()
    ]);
});