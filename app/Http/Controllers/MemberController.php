<?php

namespace App\Http\Controllers;

use App\Commands\Potentials\PromoteGuestToPotentialCommand;
use App\Commands\Potentials\SignUpAsPotentialCommand;
use App\Commands\Users\SetProfilePictureCommand;
use App\Helpers\Core\Exceptions\ValidationException;
use App\Helpers\Core\ImageHandler;
use App\Helpers\Permissions\NoPermissionException;
use App\Helpers\Users\Profiles\PotentialValidator;
use App\Helpers\Users\Profiles\ProfilesRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\MessageBag;
use Illuminate\View\View;

class MemberController extends BaseController
{
    protected $profiles;

    protected $imageHandler;

    public function __construct(ProfilesRepository $profiles, ImageHandler $imageHandler)
    {
        parent::__construct();
        $this->imageHandler = $imageHandler;
        $this->profiles = $profiles;
    }

    public function index(): View
    {
        return view('word-lid.index');
    }

    public function becomeMember(): View
    {
        return view('word-lid.word-lid');
    }

    public function becomeMemberIFrame(): View
    {
        return view('iframes.word-lid');
    }

    /**
     * This method is still a mess due to new requirements... It currently has too many
     * responsibilities. Should be refactored.
     *
     *
     * @throws ValidationException
     */
    public function store(Request $request, PotentialValidator $validator): RedirectResponse
    {
        \Log::info('Potential wil lid worden', $request->except('password', 'password_confirmation'));

        $data = $request->all(['firstname', 'middlename', 'lastname', 'gender', 'birthDay', 'birthMonth', 'birthYear',
            'address', 'zipCode', 'town', 'email', 'phone', 'studyStartYear', 'study', 'studentNumber', 'username',
            'password', 'password_confirmation', 'parents-same-address', 'parentsAddress', 'parentsZipCode',
            'parentsTown', 'parentsEmail', 'parentsPhone', 'message', 'school', 'photo_path', 'g-recaptcha-response', ]);

        // Construct a date from separate day, month and year fields.
        $data['birthdate'] = $data['birthYear'].'-'.$data['birthMonth'].'-'.$data['birthDay'];

        // Check if parent address is the same as potential address
        if ($request->get('parents-same-address', '0') == '1') {
            $data['parentsAddress'] = $data['address'];
            $data['parentsTown'] = $data['town'];
            $data['parentsZipCode'] = $data['zipCode'];
        }

        // Set username and email if the user is logged in
        $data['new_user'] = 1;
        if (Auth::check() || Auth::attempt($request->all('email', 'password'))) {
            $data['new_user'] = 0;
            $data['userId'] = Auth::user()->id;
            $data['email'] = Auth::user()->email;
            $data['username'] = Auth::user()->username;
        }

        // Validate input
        $validator->validate($data);

        // Check if the user is logged in
        if (Auth::check()) {
            // Only allow visitors here.
            if (! Auth::user()->isVisitor()) {
                throw new ValidationException(new MessageBag(['user' => 'Je hebt je al aangemeld']));
            }

            // Promote this guest to potential
            $this->dispatchFromArray(PromoteGuestToPotentialCommand::class, $data);
        } else {
            $user = $this->dispatchFromArray(SignUpAsPotentialCommand::class, $data);

            Auth::loginUsingId($user->id);
        }

        // Set the uploaded image correctly
        if ($request->hasFile('photo_path')) {
            $this->dispatch(SetProfilePictureCommand::fromRequest($request, Auth::user()));
        }

        // Redirect to the become-member page which shows some congrats page
        return redirect()->action([\App\Http\Controllers\MemberController::class, 'becomeMember']);
    }

    public function study(): View
    {
        return view('word-lid.study');
    }

    public function showCorona(): View
    {
        return view('word-lid.corona');
    }

    public function faq(): View
    {
        return view('word-lid.faq');
    }

    public function complaints(): View
    {
        return view('word-lid.complaints');
    }

    // Show original (resized) photo
    public function showPhoto(Request $request, $profile_id, $type = '')
    {
        $this->authorize('photos.show-private');

        // Guests and Potentials are not allowed to see private photos
        // but a potential can see his / her own photo
        if ($request->user()->profile->id != $profile_id && Gate::denies('users.show')) {
            throw new NoPermissionException;
        }

        return $this->photoResponse($profile_id, $type);
    }

    /**
     *   Returns an image response
     */
    private function photoResponse(int $id, string $type = '')
    {
        $profile = $this->profiles->byId($id);
        $path = $this->imageHandler->getStoragePath($profile->photo_path, $type);
        $name = $profile->user->present()->fullName;

        return response()->inlinePhoto($path, $name);
    }
}
