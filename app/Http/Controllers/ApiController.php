<?php

use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Users\User;
use GSVnet\Users\YearGroupRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

class ApiController extends BaseController {

    private $profiles;
    private $yearGroups;

    public function __construct(ProfilesRepository $profiles, YearGroupRepository $yearGroups)
    {
        $this->profiles = $profiles;
        $this->yearGroups = $yearGroups;
        parent::__construct();
    }

    public function members()
    {
        $search = Input::get('zoekwoord', '');
        $type = Input::get('type');
        $regions = Config::get('gsvnet.regions');
        $region = Input::get('regio');
        $reunistInput = Input::get('reunist');
        $reunist = null;
        $yearGroup = Input::get('jaarverband');

        // Search on region
        if (! array_key_exists($region, $regions))
            $region = null;

        // Enable search on yeargroup
        if (!$yearGroup || ! $this->yearGroups->exists($yearGroup))
            $yearGroup = null;

        // Search for reunists?
        if($reunistInput == 'ja')
            $reunist = true;
        if($reunistInput == 'nee')
            $reunist = false;

        // Search types
        if ($type != User::MEMBER && $type != User::FORMERMEMBER)
            $type = [User::MEMBER, User::FORMERMEMBER];

        $profiles = $this->profiles->searchLimit($search, $region, $yearGroup, $type, 30, $reunist);

        $formatted = $profiles->map(function($profile){
            return [
                'id' => $profile->user->id,
                'fullName' => $profile->user->present()->fullName,
                'yearGroup' => $profile->yearGroup ? $profile->yearGroup->present()->nameWithYear : ''
            ];
        });

        return response()->json($formatted);
    }
}