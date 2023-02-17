<?php

namespace App\Http\Controllers;

use App\Helpers\Events\EventsRepository;
use App\Helpers\Regions\RegionsRepository;
use App\Helpers\Users\Profiles\ProfilesRepository;
use App\Helpers\Users\User;
use App\Helpers\Users\YearGroupRepository;
use Illuminate\Support\Facades\Request;

class ApiController extends BaseController
{
    private $profiles;

    private $yearGroups;

    private $regions;

    private $events;

    public function __construct(ProfilesRepository $profiles,
                                YearGroupRepository $yearGroups,
                                RegionsRepository $regions,
                                EventsRepository $events)
    {
        $this->profiles = $profiles;
        $this->yearGroups = $yearGroups;
        $this->regions = $regions;
        $this->events = $events;
        parent::__construct();
    }

    public function members()
    {
        $search = Request::get('zoekwoord', '');
        $type = Request::get('type');
        $regions = $this->regions->all();
        $region = Request::get('regio');
        $reunist = Request::get('reunist');
        $yearGroup = Request::get('jaarverband');

        // Search on region
        if (! $region || ! $this->regions->exists($region)) {
            $region = null;
        }

        // Enable search on yeargroup
        if (! $yearGroup || ! $this->yearGroups->exists($yearGroup)) {
            $yearGroup = null;
        }

        // Search for reunists?
        if ($reunist == 'ja') {
            $type = [$type, User::REUNIST];
        } else {
            $type = [$type];
        }

        // Search types
        if (! in_array(User::MEMBER, $type) && ! in_array(User::REUNIST, $type)) {
            $type = [User::MEMBER, User::REUNIST];
        }

        $profiles = $this->profiles->searchLimit($search, $region, $yearGroup, $type, 30);

        $formatted = $profiles->map(function ($profile) {
            return [
                'id' => $profile->user->id,
                'fullName' => $profile->user->present()->fullName,
                'yearGroup' => $profile->yearGroup ? $profile->yearGroup->present()->nameWithYear : '',
            ];
        });

        return response()->json($formatted);
    }

    public function events()
    {
        $events = $this->events->upcoming();

        $formatted = $events->map(function ($event) {
            return [
                'title' => $event->title,
                'description' => $event->meta_description,
                'start_date' => $event->start_date,
                'start_time' => $event->start_time,
                'end_date' => $event->end_date,
                'type' => $event->type,
            ];
        });

        return response()->json($formatted);
    }
}
