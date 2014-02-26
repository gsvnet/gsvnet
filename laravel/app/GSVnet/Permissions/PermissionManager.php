<?php namespace GSVnet\Permissions;

use GSVnet\Users\User;
use GSVnet\Committees\CommitteeUser;
use GSVnet\Committees\Committee;
use GSVnet\Committees\CommitteesRepository;
use Config;

class PermissionManager implements PermissionManagerInterface
{
    protected $user;
    protected $guard;
    protected $committees;

    protected $permissions;

    public function __construct(CommitteesRepository $committee)
    {
        $this->committee   = $committee;
        $this->permissions = Config::get('permissions');
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function has($permission)
    {
        // Check if permission exists
        if (! array_key_exists($permission, $this->permissions))
        {
            throw new PermissionNotFoundException;
        }

        // Get the permission's criteria
        $criteria = $this->permissions[$permission];

        // A guest can't have any permissions
        if (! empty($criteria) and is_null($this->user))
        {
            return false;
        }

        // Check if type criteria is matched
        if (array_key_exists('type', $criteria) and
            $this->checkTypeCriteria($criteria['type']))
        {
            return true;
        }

        // Check if commitee criteria is matched
        if (array_key_exists('committee', $criteria) and
            $this->checkCommitteeCriteria($criteria['committee']))
        {
            return true;
        }

        return false;
    }

    private function checkTypeCriteria(array $criteria)
    {
        // Return true if user has one of the criteria
        if (in_array($this->user->type, $criteria)) { return true; }

        return false;
    }

    private function checkCommitteeCriteria(array $committees)
    {
        // Find in how many of the given committees the user is in
        // Post::find(1)->comments()->where('title', '=', 'foo')->first();
        $total = $this->user->activeCommittees()->whereIn('unique_name', $committees)->count();
        return  $total > 0;
    }
}