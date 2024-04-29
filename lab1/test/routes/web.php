<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



use App\Http\Controllers\PostController;

Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::get('posts/{id}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
Route::delete('posts/{id}/delete', [PostController::class, 'delete'])->name('posts.delete');
