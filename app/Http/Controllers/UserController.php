<?php

namespace App\Http\Controllers;

use App\Commands\Users\ChangeEmail;
use App\Commands\Users\ChangePassword;
use App\Helpers\Committees\CommitteesRepository;
use App\Helpers\Regions\RegionsRepository;
use App\Helpers\Users\EmailAndPasswordValidator;
use App\Helpers\Users\Profiles\ProfileManager;
use App\Helpers\Users\Profiles\ProfilesRepository;
use App\Helpers\Users\User;
use App\Helpers\Users\UserManager;
use App\Helpers\Users\UsersRepository;
use App\Helpers\Users\YearGroupRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
     *
     * @return
     */
    public function showProfile(Request $request): View
    {
        $member = $this->users->byIdWithProfileAndYearGroup($request->user()->id);
        $committees = $this->committees->byUserOrderByRecent($member);
        $senates = $member->senates;
        if ($member->profile && $member->profile->regions) {
            $formerRegions = array_filter($member->profile->regions->only($this->regions->former()));
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
     *
     * @return
     */
    public function showUsers(Request $request): View
    {
        $this->authorize('users.show');
        $search = $request->get('naam', '');
        $regions = $this->regions->all();
        $oudLeden = $request->get('oudleden');

        // Search on region
        if (! ($region = $request->get('regio') and $this->regions->exists($region))) {
            $region = null;
        }

        // Enable search on yeargroup
        if (! ($yeargroup = $request->get('jaarverband') and $this->yearGroups->exists($yeargroup))) {
            $yeargroup = null;
        }

        $perPage = 50;
        $types = $oudLeden == '1' ? [User::MEMBER, User::REUNIST, User::EXMEMBER] : User::MEMBER;
        $members = $this->profiles->searchAndPaginate($search, $region, $yeargroup, $types, $perPage);

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
    public function showUser($id): View
    {
        $this->authorize('users.show');
        $member = $this->users->byIdWithProfileAndYearGroup($id);
        $committees = $this->committees->byUserOrderByRecent($member);
        $senates = $member->senates;
        if ($member->profile && $member->profile->regions) {
            $formerRegions = array_filter($member->profile->regions->only($this->regions->former()));
        } else {
            $formerRegions = [];
        }

        return view('users.profile')
            ->with('member', $member)
            ->with('committees', $committees)
            ->with('senates', $senates)
            ->with('formerRegions', $formerRegions);
    }

    public function editProfile(Request $request): View
    {
        return view('users.edit-profile')->with([
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(Request $request, EmailAndPasswordValidator $validator): RedirectResponse
    {
        $data = $request->all('email', 'password', 'password_confirmation');
        $user = $request->user();
        $validator->forUser($user)->validate($data);

        if ($user->email != $data['email']) {
            $this->dispatch(ChangeEmail::fromForm($request, $user));
        }

        if (! empty($data['password'])) {
            $this->dispatch(ChangePassword::fromForm($request, $user));
        }

        return redirect()->action([\App\Http\Controllers\UserController::class, 'showProfile']);
    }
}
