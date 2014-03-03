<?php namespace GSVnet\Users;

class UsersRepository {

    /**
     * Get by id
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

    public function paginateWhereType($type, $amount)
    {
        return User::orderBy('lastname', 'ASC')
            ->where('type', $type)
            ->paginate($amount);
    }

    /**
    * Create user
    *
    * @param array $input
    * @return User
    */
    public function create(array $input)
    {
        return $user = User::create(array(
            'firstname'    => $input['register-firstname'],
            'middlename'   => $input['register-middlename'],
            'lastname'     => $input['register-lastname'],
            'email'        => $input['register-email'],
            'username'     => $input['register-username'],
            'password'     => $input['register-password'],
            'type'         => $input['type'],
        ));
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
        $user = $this->byId($id);
        $user->email = $input['email'];
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