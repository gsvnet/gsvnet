<?php namespace Admin;

use GSV\Commands\Members\ChangeAddress;
use GSV\Commands\Members\ChangeBirthDay;
use GSV\Commands\Members\ChangeBusiness;
use GSV\Commands\Members\ChangeEmail;
use GSV\Commands\Members\ChangeGender;
use GSV\Commands\Members\ChangeName;
use GSV\Commands\Members\ChangeParentsDetails;
use GSV\Commands\Members\ChangePhone;
use GSV\Commands\Members\ChangeYearGroup;
use GSV\Commands\Users\SetProfilePictureCommand;
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
        $this->authorize('user.manage.name', $user);
        return view('admin.users.update.name')->with(compact('user'));
    }

    public function updateName(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.name', $member);
        $this->dispatch(ChangeName::fromForm($request, $member));
        flash()->success("Naam {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editContactDetails($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.address', $user);
        $this->authorize('user.manage.phone', $user);
        return view('admin.users.update.contact')->with(compact('user'));
    }

    public function updateContactDetails(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.address', $member);
        $this->authorize('user.manage.phone', $member);

        $this->dispatch(ChangeAddress::fromForm($request, $member));
        $this->dispatch(ChangePhone::fromForm($request, $member));
        flash()->success("Contactgegevens {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editParentContactDetails($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.parents', $user);

        return view('admin.users.update.parents')->with(compact('user'));
    }

    public function updateParentContactDetails(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.parents', $member);

        $this->dispatch(ChangeParentsDetails::fromForm($request, $member));
        flash()->success("Gegevens van {$member->present()->fullName()}s ouders succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editBirthDay($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.birthday', $user);

        return view('admin.users.update.birthday')->with(compact('user'));
    }

    public function updateBirthDay(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.birthday', $member);

        $this->dispatch(ChangeBirthDay::fromForm($request, $member));

        flash()->success("Geboortedatum {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editEmail($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.email', $user);

        return view('admin.users.update.email')->with(compact('user'));
    }

    public function updateEmail(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.email', $member);

        $this->dispatch(ChangeEmail::fromForm($request, $member));
        flash()->success("Email {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editGender($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.gender', $user);

        return view('admin.users.update.gender')->with(compact('user'));
    }

    public function updateGender(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.gender', $member);

        $gender = new Gender($request->has('gender') ? $request->get('gender') : null);
        $this->dispatch(new ChangeGender($member, $gender));
        flash()->success("Geslacht {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editYearGroup($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.year', $user);

        $yearGroups = $this->yearGroups->all();
        return view('admin.users.update.yeargroup')->with(compact('user', 'yearGroups'));
    }

    public function updateYearGroup(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.year', $member);

        $group = $this->yearGroups->byId($request->get('year_group_id'));
        $this->dispatch(new ChangeYearGroup($member, $group));

        flash()->success("Jaarverband {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editBusiness($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.business', $user);

        return view('admin.users.update.business')->with(compact('user'));
    }

    public function updateBusiness(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.business', $member);

        $this->dispatch(ChangeBusiness::fromForm($request, $member));
        flash()->success("Werk {$member->present()->fullName()} succesvol aangepast");
        return redirect()->action('Admin\UsersController@show', $id);
    }

    public function editPhoto($id)
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.photo', $user);

        return view('admin.users.update.photo')->with(compact('user'));
    }

    public function updatePhoto(Request $request, $id)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.photo', $member);

        if ($request->hasFile('photo_path')) {
            $this->dispatch(new SetProfilePictureCommand($member, $request->file('photo_path')));
        }
        flash()->success("Foto van {$member->present()->fullName()} succesvol opgeslagen");
        return redirect()->action('Admin\UsersController@show', $id);
    }
}