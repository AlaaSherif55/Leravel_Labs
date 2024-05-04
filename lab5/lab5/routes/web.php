<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
Route::get('/', function () {
    return view('welcome');
});



use App\Http\Controllers\PostController;

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::post('posts', [PostController::class, 'store'])->name('posts.store');
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('posts/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::get('posts/pruneOldPosts', [PostController::class, 'pruneOldPosts'])->name('posts.pruneOldPost');
Route::get('posts/profile', [PostController::class, 'showUserPosts'])->name('posts.profile');

Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('posts/{id}', [PostController::class, 'update'])->name('posts.update');




Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

Route::get('posts/{id}/delete', [PostController::class, 'destroy'])->name('posts.destroy');

Route::delete('posts/{id}', [PostController::class, 'delete'])->name('posts.delete');

use App\Http\Controllers\CommentController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('comment/{id}', [CommentController::class, 'show'])->name('comment.show');
Route::post('comment', [CommentController::class, 'store'])->name('comment.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

///////////////////////login with gihub

 
Route::get('/auth/redirect', function () {
    //    return 'hi';
        return Socialite::driver('github')->redirect();
    })->name('auth.github');
    
Route::get('/auth/callback', function () {
        $githubUser = Socialite::driver('github')->user();
    //    dd($githubUser);
        $user = User::updateOrCreate([
            'github_id' => $githubUser->id,
        ], [
            'name' => $githubUser->nickname,
            'email' => $githubUser->email,
            'github_token' => $githubUser->token,
            'github_refresh_token' => $githubUser->refreshToken,
            'password'=>$githubUser->token
        ]);
    
        Auth::login($user);
    
        return redirect('/posts');
    
    });