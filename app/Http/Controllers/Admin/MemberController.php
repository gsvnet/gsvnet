<?php

namespace Admin;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Commands\Members\ChangeAddress;
use App\Commands\Members\ChangeBirthDay;
use App\Commands\Members\ChangeBusiness;
use App\Commands\Members\ChangeGender;
use App\Commands\Members\ChangeMembershipStatus;
use App\Commands\Members\ChangeName;
use App\Commands\Members\ChangeParentsDetails;
use App\Commands\Members\ChangePeriodOfMembership;
use App\Commands\Members\ChangePhone;
use App\Commands\Members\ChangeRegion;
use App\Commands\Members\ChangeStudy;
use App\Commands\Members\ChangeUsername;
use App\Commands\Members\ChangeYearGroup;
use App\Commands\Members\ForgetMember;
use App\Commands\Members\MemberIsAlive;
use App\Commands\Members\ReceiveNewspaper;
use App\Commands\Users\ChangeEmail;
use App\Commands\Users\ChangePassword;
use App\Commands\Users\SetProfilePictureCommand;
use App\Helpers\Regions\RegionsRepository;
use App\Helpers\Users\ProfileActions\ProfileActionsRepository;
use App\Helpers\Users\User;
use App\Helpers\Users\UsersRepository;
use App\Helpers\Users\UserTransformer;
use App\Helpers\Users\ValueObjects\Gender;
use App\Helpers\Users\YearGroupRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Writers\CellWriter;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;

class MemberController extends AdminBaseController
{
    private $users;

    /**
     * @var YearGroupRepository
     */
    private $yearGroups;

    /**
     * @var ProfileActionsRepository
     */
    private $actions;

    private $regions;

    public function __construct(
        ProfileActionsRepository $actions,
        UsersRepository $users,
        YearGroupRepository $yearGroups,
        RegionsRepository $regions
    ) {
        parent::__construct();
        $this->users = $users;
        $this->yearGroups = $yearGroups;
        $this->actions = $actions;
        $this->regions = $regions;
    }

    public function latestUpdates(): View
    {
        $changes = $this->actions->latestUpdatesWithMembers();

        return view('admin.users.latestUpdates')->with(compact('changes'));
    }

    public function editName($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.name', $user);

        return view('admin.users.update.name')->with(compact('user'));
    }

    public function updateName(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.name', $member);

        $this->dispatch(ChangeName::fromForm($request, $member));

        flash()->success("Naam {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editUsername($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('users.manage');

        return view('admin.users.update.username')->with(compact('user'));
    }

    public function updateUsername(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('users.manage');

        $this->dispatch(ChangeUsername::fromForm($request, $member));

        flash()->success("Naam {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editContactDetails($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.address', $user);
        $this->authorize('user.manage.phone', $user);

        return view('admin.users.update.contact')->with(compact('user'));
    }

    public function updateContactDetails(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.address', $member);
        $this->authorize('user.manage.phone', $member);

        $this->dispatch(ChangeAddress::fromForm($request, $member));
        $this->dispatch(ChangePhone::fromForm($request, $member));

        flash()->success("Contactgegevens {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editParentContactDetails($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.parents', $user);

        return view('admin.users.update.parents')->with(compact('user'));
    }

    public function updateParentContactDetails(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.parents', $member);

        $this->dispatch(ChangeParentsDetails::fromForm($request, $member));

        flash()->success("Gegevens van {$member->present()->fullName()}s ouders succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editBirthDay($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.birthday', $user);

        return view('admin.users.update.birthday')->with(compact('user'));
    }

    public function updateBirthDay(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.birthday', $member);

        $this->dispatch(ChangeBirthDay::fromForm($request, $member));

        flash()->success("Geboortedatum {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editEmail($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.email', $user);

        return view('admin.users.update.email')->with(compact('user'));
    }

    public function updateEmail(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.email', $member);

        $this->dispatch(ChangeEmail::fromForm($request, $member));

        flash()->success("Email {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editPassword($id): View
    {
        $user = $this->users->byId($id);
        $this->authorize('user.manage.password', $user);

        return view('admin.users.update.password')->with(compact('user'));
    }

    public function updatePassword(Request $request, $id): RedirectResponse
    {
        $member = $this->users->byId($id);
        $this->authorize('user.manage.password', $member);

        $this->dispatch(ChangePassword::fromForm($request, $member));

        flash()->success("Wachtwoord {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editGender($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.gender', $user);

        return view('admin.users.update.gender')->with(compact('user'));
    }

    public function updateGender(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.gender', $member);

        $gender = new Gender($request->has('gender') ? $request->get('gender') : null);
        $this->dispatch(new ChangeGender($member, $request->user(), $gender));

        flash()->success("Geslacht {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editYearGroup($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('users.manage');

        $yearGroups = $this->yearGroups->all();

        return view('admin.users.update.yeargroup')->with(compact('user', 'yearGroups'));
    }

    public function updateYearGroup(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('users.manage', $member);

        $group = $this->yearGroups->byId($request->get('year_group_id'));
        $this->dispatch(new ChangeYearGroup($member, $request->user(), $group));

        flash()->success("Jaarverband {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editBusiness($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.business', $user);

        return view('admin.users.update.business')->with(compact('user'));
    }

    public function updateBusiness(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.business', $member);

        $this->dispatch(ChangeBusiness::fromForm($request, $member));

        flash()->success("Werk {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editStudy($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.study', $user);

        return view('admin.users.update.study')->with(compact('user'));
    }

    public function updateStudy(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.study', $member);

        $this->dispatch(ChangeStudy::fromForm($request, $member));

        flash()->success("Studie van {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editMembershipPeriod($id): View
    {
        $this->authorize('users.manage');

        $user = $this->users->memberOrFormerByIdWithProfile($id);

        return view('admin.users.update.membershipPeriod')->with(compact('user'));
    }

    public function updateMembershipPeriod(Request $request, $id): RedirectResponse
    {
        $this->authorize('users.manage');

        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->dispatch(ChangePeriodOfMembership::fromForm($request, $member));

        flash()->success("Periode van lidmaatschap {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editRegion($id): View
    {
        $this->authorize('users.manage');

        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $userRegions = $user->profile->regions;

        $currentRegions = $this->regions->current();
        $formerRegions = $this->regions->former();

        return view('admin.users.update.region')->with(compact('user', 'userRegions', 'currentRegions', 'formerRegions'));
    }

    public function updateRegion(Request $request, $id): RedirectResponse
    {
        $this->authorize('users.manage');

        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $currentRegion = [$request->get('current_region')];
        $formerRegion = $request->get('former_regions') ? $request->get('former_regions') : [];

        $regions = $this->regions->byIds(array_merge($currentRegion, $formerRegion));

        $this->dispatch(new ChangeRegion($member, $request->user(), $regions));

        flash()->success("Regio van {$member->present()->fullName()} succesvol aangepast");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editMembershipStatus($id): View
    {
        $this->authorize('users.manage');

        $user = $this->users->memberOrFormerByIdWithProfile($id);

        return view('admin.users.update.membership')->with(compact('user'));
    }

    public function makeReunist(Request $request, $id): RedirectResponse
    {
        $this->authorize('users.manage');

        $member = $this->users->memberOrFormerByIdWithProfile($id);

        $this->dispatch(new ChangeMembershipStatus(User::REUNIST, $member, $request->user()));

        flash()->success("{$member->present()->fullName()} is nu reünist");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function makeExMember(Request $request, $id): RedirectResponse
    {
        $this->authorize('users.manage');

        $member = $this->users->memberOrFormerByIdWithProfile($id);

        $this->dispatch(new ChangeMembershipStatus(User::EXMEMBER, $member, $request->user()));

        flash()->success("{$member->present()->fullName()} is nu oud-lid");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function makeMember(Request $request, $id): RedirectResponse
    {
        $this->authorize('users.manage');

        $member = $this->users->memberOrFormerByIdWithProfile($id);

        $this->dispatch(new ChangeMembershipStatus(User::MEMBER, $member, $request->user()));

        flash()->success("{$member->present()->fullName()} is nu lid");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editPhoto($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.photo', $user);

        return view('admin.users.update.photo')->with(compact('user'));
    }

    public function updatePhoto(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.photo', $member);

        if ($request->hasFile('photo_path')) {
            $this->dispatch(SetProfilePictureCommand::fromRequest($request, $member));
        }

        flash()->success("Foto van {$member->present()->fullName()} succesvol opgeslagen");

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editAlive($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('users.manage');

        return view('admin.users.update.alive')->with(compact('user'));
    }

    public function updateAlive(Request $request, $id): RedirectResponse
    {
        $this->authorize('users.manage');

        $member = $this->users->memberOrFormerByIdWithProfile($id);

        $this->dispatch(MemberIsAlive::fromForm($request, $member));

        flash()->success('Status gewijzigd');

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function editNewspaper($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.receive_newspaper', $user);

        return view('admin.users.update.newspaper')->with(compact('user'));
    }

    public function updateNewspaper(Request $request, $id): RedirectResponse
    {
        $member = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('user.manage.receive_newspaper', $member);

        $this->dispatch(ReceiveNewspaper::fromForm($request, $member));

        flash()->success('Voorkeuren opgeslagen');

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }

    public function exportNewspaperRecipients()
    {
        $this->authorize('users.show');
        $transformer = new UserTransformer;
        $date = Carbon::now()->format('d-m-Y');

        $members = $this->users->getSICRecipients()->sortBy(function (User $user) {
            return $user->profile->zip_code;
        });

        $recipients = $transformer->collectionMemberSICData($members);

        Excel::create("SIC-ontvangers-{$date}", function (LaravelExcelWriter $excel) use ($date, $recipients) {
            $excel->setTitle("SIC-ontvangers-{$date}");
            $excel->sheet('SIC-ontvangers', function (LaravelExcelWorksheet $sheet) use ($recipients) {
                $sheet->fromArray($recipients);
                $sheet->setAutoFilter();
                $sheet->setAutoSize(true);
                $sheet->cells('A1:Z1', function (CellWriter $cells) {
                    $cells->setFontWeight(true);
                });
            });
        })->export('xls');
    }

    public function setForget($id): View
    {
        $user = $this->users->memberOrFormerByIdWithProfile($id);
        $this->authorize('users.manage');

        return view('admin.users.settingsForget')->with(compact('user'));
    }

    public function forget(Request $request, $id): RedirectResponse
    {
        $this->authorize('users.manage');
        $user = $this->users->byId($id);

        $this->dispatch(ForgetMember::fromForm($request, $user));

        flash()->success('Profiel en account opgeschoond.');

        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $id);
    }
}
