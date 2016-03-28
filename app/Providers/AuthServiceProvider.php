<?php namespace GSV\Providers;

use GSVnet\Users\User;
use GSVnet\Forum\Replies\Reply;
use GSVnet\Forum\Threads\Thread;
use GSVnet\Permissions\PermissionCache;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];
    
    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $gate->define('threads.manage', function(User $user, Thread $thread) {
            return $user->id == $thread->author_id || Permission::has('threads.manage');
        });

        $gate->define('threads.like', function(User $user, Thread $thread) {
            return $user->id != $thread->author_id;
        });

        $gate->define('replies.manage', function(User $user, Reply $reply) {
            return $user->id == $reply->author_id || Permission::has('threads.manage');
        });

        $gate->define('replies.like', function(User $user, Reply $reply) {
            return $user->id != $reply->author_id;
        });

        $gate->define('user.show', function(User $user) {
            return Permission::has('users.show');
        });

        $this->registerPolicies($gate);
    }
}