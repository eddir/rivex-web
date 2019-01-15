<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Post;
use App\Policies\PostPolicy;
use App\Models\Comment;
use App\Policies\CommentPolicy;
use App\Models\Bug;
use App\Policies\BugPolicy;
use App\Models\Law;
use App\Policies\LawPolicy;
use App\Models\Violation;
use App\Policies\ViolationPolicy;
use App\Models\Score;
use App\Policies\ScorePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Bug::class => BugPolicy::class,
        Law::class => LawPolicy::class,
        Violation::class => ViolationPolicy::class,
        Score::class => ScorePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
