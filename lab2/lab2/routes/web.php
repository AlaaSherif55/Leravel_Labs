<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



use App\Http\Controllers\PostController;

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::post('posts', [PostController::class, 'store'])->name('posts.store');
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');


Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('posts/{id}', [PostController::class, 'update'])->name('posts.update');

Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::get('posts/{id}/delete', [PostController::class, 'destroy'])->name('posts.destroy');

Route::delete('posts/{id}', [PostController::class, 'delete'])->name('posts.delete');

