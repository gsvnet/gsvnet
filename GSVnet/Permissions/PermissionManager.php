<?php namespace GSVnet\Permissions;

use GSVnet\Committees\CommitteesRepository;
use Config;

class PermissionManager implements PermissionManagerInterface
{
    protected $user;
    protected $guard;
    protected $committees;
    protected $permissions;
    protected $permissionCache = [];

    public function __construct(CommitteesRepository $committee)
    {
        $this->committee = $committee;
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
            throw new PermissionNotFoundException;

        // Return result away if the permission has already been looked up
        if( $this->inCache($permission) )
            return $this->getCachedResult($permission);

        // If the result was not cached: look it up
        $has = $this->hasPermission($permission);

        // Cache the result for further use
        $this->permissionCache[$permission] = $has;

        return $has;
    }

    private function hasPermission($permission)
    {
        // Get the permission's criteria
        $criteria = $this->permissions[$permission];

        // A guest can't have any permissions
        if (! empty($criteria) and is_null($this->user))
            return false;

        // Check if type criteria is matched
        if (array_key_exists('type', $criteria) and $this->checkTypeCriteria($criteria['type']))
            return true;

        // Check if committee criteria is matched
        if (array_key_exists('committee', $criteria) and $this->checkCommitteeCriteria($criteria['committee']))
            return true;

        // Check senate criteria
        if (array_key_exists('senate', $criteria) and $this->checkSenateCriteria())
            return true;

        return false;
    }

    /**
     * Checks if a permission has already been looked up for the user
     */
    private function inCache($permission)
    {
        return array_key_exists($permission, $this->permissionCache);
    }

    /**
     * Returns whether an entity has the permission or not (from cache)
     */
    private function getCachedResult($permission)
    {
        return $this->permissionCache[$permission];
    }

    private function checkTypeCriteria(array $criteria)
    {
        // Return true if user has one of the criteria
        return in_array($this->user->type, $criteria);
    }

    private function checkCommitteeCriteria(array $committees)
    {
        // Find in how many of the given committees the user is in
        $total = $this->user->activeCommittees()->whereIn('unique_name', $committees)->count();
        return  $total > 0;
    }

    public function checkSenateCriteria()
    {
        $total = $this->user->activeSenate->count();

        return $total > 0;
    }
}