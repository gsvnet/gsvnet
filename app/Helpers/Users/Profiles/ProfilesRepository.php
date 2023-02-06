<?php namespace GSV\Helpers\Users\Profiles;

use GSV\Helpers\Core\BaseRepository;
use GSV\Helpers\Users\User;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class ProfilesRepository extends BaseRepository {

    public function __construct(UserProfile $model)
    {
        $this->model = $model;
    }

    public function byId($id)
    {
        return UserProfile::findOrFail($id);
    }

    /**
     *   Search for members and paginate
     *
     * @param string $search
     * @param int $region
     * @param int $yearGroup
     * @param int|array $type
     * @param int $amount
     *
     * @return UserProfile[]
     */
    public function searchAndPaginate($search, $region = null, $yearGroup = null, $type = 2, $amount = 20)
    {
        return $this->search($search, $region, $yearGroup, $type)->paginate($amount);
    }

    public function searchLimit($search, $region = null, $yearGroup = null, $type = 2, $amount = 20)
    {
        return $this->search($search, $region, $yearGroup, $type)->take($amount)->get();
    }

    /**
     *   Search for users + profiles
     *
     * @param string $keyword
     * @param int $region
     * @param int $yearGroup
     * @param int $type
     *
     * @return UserProfile[]
     */
    public function search($keyword = '', $region = null, $yearGroup = null, $type = 2)
    {
        // Initialize basic query
        $query = UserProfile::with('user', 'yearGroup', 'regions')
            ->join('users', function($join) use ($type) {
                $join->on('users.id', '=', 'user_profiles.user_id');
            })
            ->leftJoin('region_user_profile', 'user_profiles.id', '=', 'region_user_profile.user_profile_id')
            ->leftJoin('regions', 'region_user_profile.region_id', '=', 'regions.id')
            ->groupBy('user_profiles.id');

        if(is_array($type))
            $query->whereIn('users.type', $type);
        else
            $query->where('users.type', '=', $type);

        $query->orderBy('users.lastname')->orderBy('users.firstname');

        if ( ! empty($keyword))
        {
            $words = explode(' ', $keyword);

            $query->searchNameAndPhone($words);
        }

        // Search for members inside region if region is valid
        if (isset($region))
            $query->where('regions.id', '=', $region);

        // Search for members inside year group if year group is valid
        if (isset($yearGroup))
            $query->where('year_group_id', '=', $yearGroup);

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
        $from = $now->format('Y-m-d');
        $to = $now->addWeeks($weeks)->format('Y-m-d');

        $birthday = "date_format(birthdate, \"{$year}-%m-%d\")";

        return Cache::remember('birthdays', 10, function() use ($birthday, $from, $to)
        {
            return UserProfile::whereRaw("$birthday between \"{$from}\" and \"{$to}\"")
                ->whereHas('user', function($q) {
                    $q->where('type', '=', User::Member);
                })
                ->orderBy(\DB::raw($birthday))
                ->orderBy('birthdate', 'ASC')
                ->get(array('*', \DB::raw("{$birthday} as birthday")));
        });
    }


    /**
    * Create profile
    *
    * @param array $input
    * @return User
    */
    public function create(User $user, array $input)
    {
        $profile = UserProfile::create(array('user_id' => $user->id));
        $profile->user_id = $user->id;

        $profile->phone            = $input['potential-phone'];
        $profile->address          = $input['potential-address'];
        $profile->zip_code         = $input['potential-zip-code'];
        $profile->town             = $input['potential-town'];
        $profile->study            = $input['potential-study'];
        $profile->birthdate        = $input['potential-birthdate'];
        $profile->gender           = $input['potential-gender'];
        $profile->student_number   = $input['potential-student-number'];

        $profile->parent_phone     = $input['parents-phone'];
        $profile->parent_address   = $input['parents-address'];
        $profile->parent_zip_code  = $input['parents-zip-code'];
        $profile->parent_town      = $input['parents-town'];

        $profile->photo_path       = $input['photo_path'];

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

    public function createProfileFor(User $user)
    {
        $user->profile()->save(UserProfile::create([]));
    }
}