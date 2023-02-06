<?php namespace App\Helpers\Permissions;

use App\Helpers\Users\User;

class PermissionCache
{
    /**
     * @array
     */
    private $permissions = [];

    /**
     * @param User $user
     * @param $permission
     * @return bool
     */
    public function has(User $user, $permission)
    {
        return $this->hasUser($user) && $this->hasUserPermission($user, $permission);
    }

    /**
     * @param User $user
     * @param $permission
     * @return mixed
     */
    public function get(User $user, $permission)
    {
        return $this->permissions[$user->id][$permission];
    }

    /**
     * @param User $user
     * @param $permission
     * @param $access
     * @return boolean
     */
    public function set(User $user, $permission, $access)
    {
        if (! $this->hasUser($user))
            $this->permissions[$user->id] = [];
        
        $this->permissions[$user->id][$permission] = $access;
        return $access;
    }

    /**
     * @param User $user
     * @return mixed
     */
    private function hasUser(User $user)
    {
        return array_key_exists($user->id, $this->permissions);
    }

    /**
     * @param User $user
     * @param $permission
     * @return mixed
     */
    private function hasUserPermission(User $user, $permission)
    {
        return array_key_exists($permission, $this->permissions[$user->id]);
    }
}