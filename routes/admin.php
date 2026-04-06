<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return "Hello Admin";
// })->name('Dashboard');

// Route::get('/cursos', function () {
//     return "Admin Users";
// })->name('cursos');

Route::resource('categories', CategoryController::class);