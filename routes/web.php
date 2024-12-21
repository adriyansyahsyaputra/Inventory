<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', [
        'title' => 'Dashboard'
    ]);
});

Route::get('/add-product', function () {
    return view('addProduct', [
        'title' => 'New Product'
    ]);
});

Route::get('/table-product', function () {
    return view('tableProduct', [
        'title' => 'Table Product'
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