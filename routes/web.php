<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
        use App\Http\Controllers\PostPublicController;


Route::resource('admin/posts', PostController::class)->names('admin.posts');
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Esta es la ruta para el Dashboard normal
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Esta es la ruta para gestionar categorías
    Route::resource('categories', CategoryController::class)
        ->names('admin.categories');

        Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('categories', CategoryController::class)
        ->names('admin.categories');
        
// Página principal para el público
Route::get('/', [PostPublicController::class, 'index'])->name('home');
// Detalle del post
Route::get('/blog/{post:slug}', [PostPublicController::class, 'show'])->name('posts.show');
});
});

require __DIR__.'/settings.php';