<?php

use GSV\Commands\Users\ChangeEmail;
use GSV\Commands\Users\ChangePassword;
use GSVnet\Users\EmailAndPasswordValidator ;
use Illuminate\Http\Request;
use GSVnet\Committees\CommitteesRepository;
use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Users\User;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserManager;
use GSVnet\Users\Profiles\ProfileManager;
use GSVnet\Users\YearGroupRepository;
use GSVnet\Regions\RegionsRepository;

class UserController extends BaseController
{

    protected $users;
    protected $profiles;
    protected $committees;
    protected $yearGroups;
    protected $regions;
    protected $profileManager;
    protected $userManager;

    public function __construct(
        ProfilesRepository $profiles,
        UsersRepository $users,
        CommitteesRepository $committees,
        UserManager $userManager,
        ProfileManager $profileManager,
        YearGroupRepository $yearGroups,
        RegionsRepository $regions
    ) {
        parent::__construct();
        $this->profiles = $profiles;
        $this->users = $users;
        $this->committees = $committees;
        $this->yearGroups = $yearGroups;
        $this->userManager = $userManager;
        $this->profileManager = $profileManager;
        $this->committees = $committees;
        $this->regions = $regions;
    }

    /**
     * Show the current user's profile
     * @param Request $request
     * @return
     */
    public function showProfile(Request $request)
    {
        $member = $this->users->byIdWithProfileAndYearGroup($request->user()->id);
        $committees = $this->committees->byUserOrderByRecent($member);
        $senates = $member->senates;
        if($member->profile && $member->profile->regions){
            $formerRegions = $member->profile->regions->intersect($this->regions->former());
        } else {
            $formerRegions = [];
        }

        return view('users.profile')
            ->with('member', $member)
            ->with('committees', $committees)
            ->with('senates', $senates)
            ->with('formerRegions', $formerRegions);
    }

    /**
     * Show current members
     * @param Request $request
     * @return
     */
    public function showUsers(Request $request)
    {
        $this->authorize('users.show');
        $search = $request->get('naam', '');
        $regions = $this->regions->all();
        $oudLeden = $request->get('oudleden');

        // Search on region
        if (!($region = $request->get('regio') and $this->regions->exists($region)))
            $region = null;

        // Enable search on yeargroup
        if (!($yeargroup = $request->get('jaarverband') and $this->yearGroups->exists($yeargroup))) {
            $yeargroup = null;
        }

        $perPage = 50;
        $type = $oudLeden == '1' ? [User::MEMBER, User::FORMERMEMBER] : User::MEMBER;
        $members = $this->profiles->searchAndPaginate($search, $region, $yeargroup, $type, $perPage);

        // Select year groups
        $yearGroups = $this->yearGroups->all();

        // Create the view
        return view('users.index')
            ->with('members', $members)
            ->with('regions', $regions)
            ->with('yearGroups', $yearGroups);
    }

    /**
     * Show the user's profile
     */
    public function showUser($id)
    {
        $this->authorize('users.show');
        $member = $this->users->byIdWithProfileAndYearGroup($id);
        $committees = $this->committees->byUserOrderByRecent($member);
        $senates = $member->senates;
        if($member->profile && $member->profile->regions){
            $formerRegions = $member->profile->regions->intersect($this->regions->former());
        } else {
            $formerRegions = [];
        }
        
        return view('users.profile')
            ->with('member', $member)
            ->with('committees', $committees)
            ->with('senates', $senates)
            ->with('formerRegions', $formerRegions);
    }

    public function editProfile(Request $request)
    {
        return view('users.edit-profile')->with([
            'user' => $request->user()
        ]);
    }

    public function updateProfile(Request $request, EmailAndPasswordValidator $validator)
    {
        $data = $request->only('email', 'password', 'password_confirmation');
        $user = $request->user();
        $validator->forUser($user)->validate($data);

        if ($user->email != $data['email']) {
            $this->dispatch(ChangeEmail::fromForm($request, $user));
        }
        
        if (! empty($data['password'])) {
            $this->dispatch(ChangePassword::fromForm($request, $user));
        }

        return redirect()->action('UserController@showProfile');
    }

    public function showAddresses()
    {
        $this->authorize('users.show');
        return view('trivia/locations');
    }
}