<?php namespace Admin;

use GSV\Commands\Members\ChangeAddress;
use GSV\Commands\Members\ChangeBirthDay;
use GSV\Commands\Members\ChangeBusiness;
use GSV\Commands\Members\ChangeEmail;
use GSV\Commands\Members\ChangeGender;
use GSV\Commands\Members\ChangeName;
use GSV\Commands\Members\ChangeYearGroup;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\ValueObjects\Gender;
use GSVnet\Users\YearGroupRepository;
use Illuminate\Http\Request;

class MemberController extends AdminBaseController
{
    private $users;
    /**
     * @var YearGroupRepository
     */
    private $yearGroups;

    /**
     * @param UsersRepository $users
     * @param YearGroupRepository $yearGroups
     */
    public function __construct(UsersRepository $users, YearGroupRepository $yearGroups)
    {
        $this->users = $users;
        $this->yearGroups = $yearGroups;
        parent::__construct();
    }

    public function editName($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        return view('admin.users.update.name')->with(compact('user'));
    }

    public function updateName(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->dispatch(ChangeName::fromForm($request, $member));
        flash()->success("Naam {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editAddress($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        return view('admin.users.update.address')->with(compact('user'));
    }

    public function updateAddress(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->dispatch(ChangeAddress::fromForm($request, $member));
        flash()->success("Adres {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editBirthDay($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        return view('admin.users.update.birthday')->with(compact('user'));
    }

    public function updateBirthDay(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->dispatch(ChangeBirthDay::fromForm($request, $member));
        flash()->success("Geboortedatum {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editEmail($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        return view('admin.users.update.email')->with(compact('user'));
    }

    public function updateEmail(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->dispatch(ChangeEmail::fromForm($request, $member));
        flash()->success("Email {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editGender($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        return view('admin.users.update.gender')->with(compact('user'));
    }

    public function updateGender(Request $request, $id)
    {
        $gender = new Gender($request->has('gender') ? $request->get('gender') : null);
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->dispatch(new ChangeGender($member, $gender));
        flash()->success("Geslacht {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editYearGroup($id)
    {
        $yearGroups = $this->yearGroups->all();
        $user = $this->users->memberOrFormerByIdWithProfile($id);

        return view('admin.users.update.yeargroup')->with(compact('user', 'yearGroups'));
    }

    public function updateYearGroup(Request $request, $id)
    {
        $group = $this->yearGroups->byId($request->get('year_group_id'));
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->dispatch(new ChangeYearGroup($member, $group));
        flash()->success("Jaarverband {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editBusiness($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        return view('admin.users.update.business')->with(compact('user'));
    }

    public function updateBusiness(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->dispatch(ChangeBusiness::fromForm($request, $member));
        flash()->success("Werk {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }
}