<?php

namespace App\Providers;

use App\Models\posts;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\postPolicy;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // add service gate only post creator  can update or delete post
        Gate::define('post-onwer', function (User $user, posts $post) {
            return $user->id === $post->user_id;
        });

        Gate::policy(posts::class, postPolicy::class);

    }
}
