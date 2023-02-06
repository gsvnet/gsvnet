<?php

namespace App\Providers;

use App\Helpers\Forum\Replies\Reply;
use App\Helpers\Forum\Threads\Thread;
use App\Helpers\Permissions\PermissionCache;
use App\Helpers\Users\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    protected $permissions;

    /**
     * @var PermissionCache
     */
    protected $cache;

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @param  Config  $config
     * @param  PermissionCache  $cache
     *
     * @internal param PermissionManager $manager
     */
    public function boot(GateContract $gate, Config $config, PermissionCache $cache)
    {
        $this->cache = $cache;
        $this->permissions = $config->get('permissions.general') + $config->get('permissions.entity-specific');

        foreach ($config->get('permissions.general') as $permission => $criteria) {
            $gate->define($permission, function (User $user) use ($permission) {
                return $this->has($user, $permission);
            });
        }

        // Register entity-specific permissions here
        $gate->define('thread.manage', function (User $user, Thread $thread = null) {
            return ($thread && $user->id == $thread->author_id) || $this->has($user, 'thread.manage');
        });

        $gate->define('thread.like', function (User $user, Thread $thread) {
            return $user->id != $thread->author_id || $this->has($user, 'thread.like');
        });

        $gate->define('reply.manage', function (User $user, Reply $reply) {
            return $user->id == $reply->author_id || $this->has($user, 'reply.manage');
        });

        $gate->define('reply.like', function (User $user, Reply $reply) {
            return $user->id != $reply->author_id || $this->has($user, 'reply.like');
        });

        // User details
        $gate->define('user.manage.address', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.address');
        });

        $gate->define('user.manage.birthday', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.birthday');
        });

        $gate->define('user.manage.business', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.business');
        });

        $gate->define('user.manage.email', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.email');
        });

        $gate->define('user.manage.gender', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.gender');
        });

        $gate->define('user.manage.name', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.name');
        });

        $gate->define('user.manage.parents', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.parents');
        });

        $gate->define('user.manage.password', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.password');
        });

        $gate->define('user.manage.phone', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.phone');
        });

        $gate->define('user.manage.photo', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.photo');
        });

        $gate->define('user.manage.study', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.study');
        });

        $gate->define('formerMember.manage.year', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'formerMember.manage.year');
        });

        $gate->define('user.manage.receive_newspaper', function (User $user, User $member) {
            return $user->id == $member->id || $this->has($user, 'user.manage.receive_newspaper');
        });
    }

    public function has(User $user, $permission)
    {
        // Return result away if the permission has already been looked up
        if ($this->cache->has($user, $permission)) {
            return $this->cache->get($user, $permission);
        }

        // Cache the result for further use
        return $this->cache->set($user, $permission, $this->hasPermission($user, $permission));
    }

    private function hasPermission(User $user, $permission)
    {
        // Get the permission's criteria
        $criteria = $this->permissions[$permission];

        // If no criteria are given, grant access right away
        if (count($criteria) == 0) {
            return true;
        }

        // Check if type criteria is matched
        if (array_key_exists('type', $criteria) and $this->checkTypeCriteria($user, $criteria['type'])) {
            return true;
        }

        // Check if committee criteria is matched
        if (array_key_exists('committee', $criteria) and $this->checkCommitteeCriteria($user, $criteria['committee'])) {
            return true;
        }

        // Check senate criteria
        if (array_key_exists('senate', $criteria) and $this->checkSenateCriteria($user)) {
            return true;
        }

        // If none of the criteria is matched, return false
        return false;
    }

    private function checkTypeCriteria(User $user, array $criteria)
    {
        // Return true if user has one of the criteria
        return in_array($user->type, $criteria);
    }

    private function checkCommitteeCriteria(User $user, array $committees)
    {
        // Find in how many of the given committees the user is in
        return $user->activeCommittees()->whereIn('unique_name', $committees)->count() > 0;
    }

    public function checkSenateCriteria(User $user)
    {
        // Check if the user is active in a senate
        return $user->activeSenate->count() > 0;
    }
}
