<?php

use GSV\Commands\Potentials\PromoteGuestToPotential;
use GSV\Commands\Potentials\PromoteGuestToPotentialCommand;
use GSV\Commands\Potentials\SignUpAsPotential;
use GSV\Commands\Potentials\SignUpAsPotentialCommand;
use GSV\Commands\Users\SetProfilePictureCommand;
use GSVnet\Core\Exceptions\ValidationException;
use GSVnet\Permissions\Permission;
use GSVnet\Users\Profiles\PotentialValidator;
use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Core\ImageHandler;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class MemberController extends BaseController {

    protected $profiles;
    protected $imageHandler;
    protected $cookie;

    public function __construct(ProfilesRepository $profiles, ImageHandler $imageHandler, CookieJar $cookie)
    {
        parent::__construct();
        $this->imageHandler = $imageHandler;
        $this->profiles = $profiles;
        $this->cookie = $cookie;
    }

    public function index()
    {
        return view('word-lid.index');
    }

    public function becomeMember()
    {
        return view('word-lid.word-lid');
    }

    /**
     * This method is still a mess due to new requirements... It currently has too many
     * responsibilities. Should be refactored.
     *
     * @param Request $request
     * @param PotentialValidator $validator
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request, PotentialValidator $validator)
    {
        \Log::info('Potential wil lid worden', $request->except('password', 'password_confirmation'));

        $data = $request->only(['firstname','middlename','lastname','gender','birthDay','birthMonth','birthYear',
            'address','zipCode','town','email','phone','studyStartYear','study','studentNumber','username',
            'password','password_confirmation','parents-same-address','parentsAddress','parentsZipCode',
            'parentsTown','parentsEmail','parentsPhone','message', 'school', 'photo_path']);

        // Construct a date from separate day, month and year fields.
        $data['birthdate'] = $data['birthYear'] . '-' . $data['birthMonth'] . '-' . $data['birthDay'];

        // Check if parent address is the same as potential address
        if ($request->get('parents-same-address', '0') == '1')
        {
            $data['parentsAddress'] = $data['address'];
            $data['parentsTown'] = $data['town'];
            $data['parentsZipCode'] = $data['zipCode'];
        }

        // Set username and email if the user is logged in
        $data['new_user'] = 1;
        if(Auth::check() || Auth::attempt($request->only('email', 'password')))
        {
            $data['new_user'] = 0;
            $data['userId'] = Auth::user()->id;
            $data['email'] = Auth::user()->email;
            $data['username'] = Auth::user()->username;
        }

        // Validate input
        $validator->validate($data);

        // Check if the user is logged in
        if(Auth::check())
        {
            // Only allow visitors here.
            if(! Auth::user()->isVisitor())
                throw new ValidationException(new MessageBag(['user' => 'Je hebt je al aangemeld']));

            // Promote this guest to potential
            $this->dispatchFromArray(PromoteGuestToPotentialCommand::class, $data);

        } else {
            $user = $this->dispatchFromArray(SignUpAsPotentialCommand::class, $data);

            Auth::loginUsingId($user->id);
        }

        // Set the uploaded image correctly
        if($request->hasFile('photo_path'))
        {
            $this->dispatchFromArray(SetProfilePictureCommand::class, [
                'user' => Auth::user(),
                'file' => $request->file('photo_path')
            ]);
        }

        // Set cache cookie
        $this->cookie->queue('logged-in', Auth::user()->id, 2628000);

        // Redirect to the become-member page which shows some congrats page
        return redirect()->action('MemberController@becomeMember');
    }

    public function faq()
    {
        return view('word-lid.faq');
    }

    // Show original (resized) photo
    public function showPhoto($profile_id, $type = '')
    {
        // Guests and Potentials are not allowed to see private photos
        // but a potential can see his / her own photo
        if ( Auth::user()->profile->id != $profile_id && ! Permission::has('users.show') )
        {
            throw new \GSVnet\Permissions\NoPermissionException;
        }
        return $this->photoResponse($profile_id, $type);
    }

    /**
    *
    *   Returns an image response
    *
    *   @param int $id
    *   @param string $type
    */
    private function photoResponse($id, $type = '')
    {
        $profile  = $this->profiles->byId($id);
        $path = $this->imageHandler->getStoragePath($profile->photo_path, $type);
        $name = $profile->user->present()->fullName;

        return response()->inlinePhoto($path, $name);
    }
}