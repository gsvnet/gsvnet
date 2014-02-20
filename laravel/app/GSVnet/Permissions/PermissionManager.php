<?php namespace GSVnet\Permissions;

use GSVnet\Users\User;
use GSVnet\Committees\CommitteesRepository;
use Config;

class PermissionManager implements PermissionManagerInterface
{
    protected $user;
    protected $committees;

    protected $permissions;

    public function __construct(User $user, CommitteesRepository $committee)
    {
        $this->user        = $user;
        $this->committee   = $committee;

        $this->permissions = Config::get('permissions');
    }

    public function has($permission)
    {
        // Get the permission's criteria
        $criteria = $this->permissions[$permission];

        // Check if type criteria is matched
        if (array_key_exists ('type', $criteria) and
            $this->checkTypeCriteria($criteria['type']))
        {
            return true;
        }

        // Check if commitee criteria is matched
        if (array_key_exists ('committee', $criteria) and
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

    private function checkCommitteeCriteria(array $criteria)
    {
        return false;
    }
}