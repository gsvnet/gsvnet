<?php namespace GSVnet\Users\Profiles;

use GSVnet\Users\Profile\UserProfile;
use GSVnet\Users\User;

class ProfilesRepository {

    /**
    * Create profile
    *
    * @param array $input
    * @return User
    */
    public function create(User $user, array $input)
    {
        $profile = UserProfile::firstOrNew(array('user_id' => $user->id));
        $profile->user_id = $user->id;
        $profile->reunist = 0;
        $profile->region  = 0;

        $profile->phone            = $input['potential-phone'];
        $profile->address          = $input['potential-address'];
        $profile->zip_code         = $input['potential-zip-code'];
        $profile->town             = $input['potential-town'];
        $profile->study            = $input['potential-study'];
        $profile->birthdate        = $input['potential-birthdate'];
        $profile->church           = $input['potential-church'];
        $profile->gender           = $input['potential-gender'];
        $profile->start_date_rug   = $input['potential-study-year'];

        $profile->parent_phone     = $input['parents-phone'];
        $profile->parent_address   = $input['parents-address'];
        $profile->parent_zip_code  = $input['parents-zip-code'];
        $profile->parent_town      = $input['parents-town'];

        $profile->save();
        // Set user as potential
        $user->type = 1;
        $user->save();

        return $profile;
    }

    /**
    * Update profile
    *
    * @param int $id
    * @param array $input
    * @return User
    */
    public function update($id, array $input)
    {
        $profile = $this->byId($id);
        $profile->fill($input);

        $profile->save();

        return $profile;
    }

    /**
    * Delete User
    *
    * @param int $id
    * @return Committe
    * @TODO: delete all profile members references
    */
    public function delete($id)
    {
        $profile = $this->byId($id);
        $profile->delete();

        return $profile;
    }
}