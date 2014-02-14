<?php namespace GSVnet\Users;

use Model\User;

class DbUsersRepository implements UsersRepositoryInterface {

    /**
     * Get by slug
     *
     * @param int $id
     * @return Album
     */
    public function byId($id)
    {
        return User::findOrFail($id);
    }

    /**
    * Get all users
    *
    * @return Collection
    */
    public function all()
    {
        return User::orderBy('lastname', 'ASC')->get();
    }

    /**
     * Get paginated users
     *
     * @param int $amount
     */
    public function paginate($amount)
    {
        return User::orderBy('lastname', 'ASC')->paginate($amount);
    }

    /**
    * Create user
    *
    * @param array $input
    * @return User
    */
    public function create(array $input)
    {
        $user = new User();

        $user->save();

        return $user;
    }

    /**
    * Update user
    *
    * @param int $id
    * @param array $input
    * @return User
    */
    public function update($id, array $input)
    {
        $user              = $this->byId($id);

        $user->save();

        return $user;
    }

    /**
    * Delete User
    *
    * @param int $id
    * @return Committe
    * @TODO: delete all user members references
    */
    public function delete($id)
    {
        $user = $this->byId($id);
        $user->delete();

        return $user;
    }
}