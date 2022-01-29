<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\BlogPost;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();


        // Add authorization gates to update function
        // Gate::define('update-post', function($user, $post){
        //     return $user->id === $post->user_id;
        // });

        // Gate::define('delete-post', function($user, $post){
        //     return $user->id === $post->user_id;
        // });

        Gate::before(function($user, $ability){
            if($user->is_admin && in_array($ability, ['update'])){
                return true;
            }
        });

        // Gate::after(function($user, $ability, $result){
        //     if($user->is_admin && in_array($ability, ['update-post'])){
        //         return true;
        //     }
        // });
    }
}
