<?php namespace GSVnet\Users\Profiles;

use GSVnet\Users\User;
use Config;
use Carbon\Carbon;

class ProfilesRepository {

    public function byId($id)
    {
        return UserProfile::findOrFail($id);
    }

    /**
    *   Search for members and paginate
    *
    *   @param string $search
    *   @param int $region
    *   @param int $yearGroup
    *   @param int $amount
    *
    *   @return UserProfile[]
    */
    public function searchAndPaginate($search, $region = null, $yearGroup = null, $amount = 20)
    {
        return $this->search($search, $region, $yearGroup)->paginate($amount);
    }

    /**
    *   Search for members
    *
    *   @param string $search
    *   @param int $region
    *   @param int $yearGroup
    *
    *   @return UserProfile[]
    */
    private function search($search = '', $region = null, $yearGroup = null)
    {
        $member = Config::get('gsvnet.userTypes.member');

        // Initialize basic query
        $query = UserProfile::join('users', function($join) use ($member) {
            $join->on('users.id', '=', 'user_profiles.user_id')->where('users.type', '=', $member);
        })->orderBy('users.lastname');

        if ( ! empty($search))
        {
            // $terms = explode(' ', $search);
            // $search = implode("*", $terms);

            $query = $query->search('*' . $search . '*');
        }

        // Search for members inside region if region is valid
        if (isset($region))
        {
            $query = $query->where('region', '=', $region);
        }

        // Search for members inside region if region is valid
        if (isset($yearGroup))
        {
            $query = $query->where('year_group_id', '=', $yearGroup);
        }

        // Retrieve results
        return $query;
    }

    /**
    *   Finds all users whose birthday is in coming $weeks
    *
    *   @param int $weeks
    *   @return UserProfile[]
    */
    public function byUpcomingBirthdays($weeks)
    {
        $now = new Carbon;
        $year = $now->year;
        $from   = $now->format('Y-m-d');
        $to     = $now->addWeeks($weeks)->format('Y-m-d');

        $birthday = "date_format(birthdate, \"{$year}-%m-%d\")";

        $profiles = UserProfile::whereRaw("$birthday between \"{$from}\" and \"{$to}\"")
            ->orderBy(\DB::raw($birthday))
            ->get(array('*', \DB::raw("{$birthday} as birthday")));

        return $profiles;
    }


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

        $profile->photo_path = $input['photo_path'];

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