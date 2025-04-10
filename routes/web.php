<?php

use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/fetch', [ProductController::class, 'fetchAndStore']);
