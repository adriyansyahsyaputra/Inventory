<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', [
        'title' => 'Dashboard'
    ]);
});

// Route::get('/add-product', function () {
//     return view('addProduct', [
//         'title' => 'New Product',
//         'categories' => Category::all()
//     ]);
// });
Route::get('add-product', [ProductController::class, 'create'])->name('product.create');
Route::post('add-product', [ProductController::class, 'store'])->name('product.store');

Route::get('/table-product', function () {
    return view('tableProduct', [
        'title' => 'Table Product',
        'products' => Product::all(),
        'categories' => Category::all()
    ]);
});

Route::get('/add-user', function () {
    return view('addUser', [
        'title' => 'New User'
    ]);
});

Route::get('/table-user', function () {
    return view('tableUser', [
        'title' => 'Table User'
    ]);
});