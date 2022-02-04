<?php

namespace App\Providers;
use App\User;
use App\Comment;
use App\Article;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('comment-delete',function(User $user,Comment $comment){
         return  $user->id == $comment->user_id;
        });

        Gate::define('article-delete',function($user,$article){
          return $user->id == $article->user_id;
        });
        //
    }
}
