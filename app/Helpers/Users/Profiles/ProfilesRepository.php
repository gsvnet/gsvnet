<?php

namespace App\Helpers\Users\Profiles;

use App\Helpers\Core\BaseRepository;
use App\Helpers\Users\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ProfilesRepository extends BaseRepository
{
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
     * @param  int|array  $type
     * @return UserProfile[]
     */
    public function searchAndPaginate(string|null $search, int $region = null, int $yearGroup = null, $type = 2, int $amount = 20): LengthAwarePaginator
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
     * @return UserProfile[]
     */
    public function search(string|null $keyword = '', int $region = null, int $yearGroup = null, int|array $type = 2): Builder
    {
        // Initialize basic query
        $query = UserProfile::with('user', 'yearGroup', 'regions')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'user_profiles.user_id');
            })
            ->leftJoin('region_user_profile', 'user_profiles.id', '=', 'region_user_profile.user_profile_id')
            ->leftJoin('regions', 'region_user_profile.region_id', '=', 'regions.id')
            ->groupBy('user_profiles.id');

        if (is_array($type)) {
            $query->whereIn('users.type', $type);
        } else {
            $query->where('users.type', '=', $type);
        }

        $query->orderBy('users.lastname')->orderBy('users.firstname');

        if (! empty($keyword)) {
            $words = explode(' ', $keyword);

            $query->searchNameAndPhone($words);
        }

        // Search for members inside region if region is valid
        if (isset($region)) {
            $query->where('regions.id', '=', $region);
        }

        // Search for members inside year group if year group is valid
        if (isset($yearGroup)) {
            $query->where('year_group_id', '=', $yearGroup);
        }

        // Retrieve results
        return $query;
    }

    /**
     *   Finds all users whose birthday is in coming $weeks
     *
     *   @param  int  $weeks
     *   @return UserProfile[]
     */
    public function byUpcomingBirthdays($weeks): array
    {
        $now = new Carbon;
        $year = $now->year;
        $from = $now->format('Y-m-d');
        $to = $now->addWeeks($weeks)->format('Y-m-d');

        $birthday = "date_format(birthdate, \"{$year}-%m-%d\")";

        return Cache::remember('birthdays', 60000, function () use ($birthday, $from, $to) {
            return UserProfile::whereRaw("$birthday between \"{$from}\" and \"{$to}\"")
                ->whereHas('user', function ($q) {
                    $q->where('type', '=', User::Member);
                })
                ->orderBy(\DB::raw($birthday))
                ->orderBy('birthdate', 'ASC')
                ->get(['*', \DB::raw("{$birthday} as birthday")]);
        });
    }

    /**
     * Create profile
     */
    public function create(User $user, array $input): User
    {
        $profile = UserProfile::create(['user_id' => $user->id]);
        $profile->user_id = $user->id;

        $profile->phone = $input['potential-phone'];
        $profile->address = $input['potential-address'];
        $profile->zip_code = $input['potential-zip-code'];
        $profile->town = $input['potential-town'];
        $profile->study = $input['potential-study'];
        $profile->birthdate = $input['potential-birthdate'];
        $profile->gender = $input['potential-gender'];
        $profile->student_number = $input['potential-student-number'];

        $profile->parent_phone = $input['parents-phone'];
        $profile->parent_address = $input['parents-address'];
        $profile->parent_zip_code = $input['parents-zip-code'];
        $profile->parent_town = $input['parents-town'];

        $profile->photo_path = $input['photo_path'];

        $profile->save();
        // Set user as potential
        $user->type = 1;
        $user->save();

        return $profile;
    }

    /**
     * Update profile
     */
    public function update(int $id, array $input): User
    {
        $profile = $this->byId($id);
        $profile->fill($input);

        $profile->save();

        return $profile;
    }

    /**
     * Delete User
     *
     * @TODO: delete all profile members references
     */
    public function delete(int $id): Committe
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
