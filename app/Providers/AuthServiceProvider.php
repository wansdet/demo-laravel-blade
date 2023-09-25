<?php

namespace App\Providers;

use App\Policies\BlogPostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('author-blog', [BlogPostPolicy::class, 'author']);
        Gate::define('admin-blog', [BlogPostPolicy::class, 'admin']);
        Gate::define('update-blog', [BlogPostPolicy::class, 'update']);
        Gate::define('submit-blog', [BlogPostPolicy::class, 'submit']);
        Gate::define('reject-blog', [BlogPostPolicy::class, 'reject']);
        Gate::define('publish-blog', [BlogPostPolicy::class, 'publish']);
        Gate::define('archive-blog', [BlogPostPolicy::class, 'archive']);
        Gate::define('delete-blog', [BlogPostPolicy::class, 'delete']);
        Gate::define('admin', function () {
            return auth()->user()->hasAdminRole();
        });
    }
}
