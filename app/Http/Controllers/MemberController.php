<?php

use GSV\Commands\Potentials\PromoteGuestToPotential;
use GSV\Commands\Potentials\SignUpAsPotential;
use GSVnet\Core\Exceptions\ValidationException;
use GSVnet\Permissions\Permission;
use GSVnet\Users\Profiles\PotentialValidator;
use GSVnet\Users\Profiles\ProfilesRepository;
use GSVnet\Core\ImageHandler;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class MemberController extends BaseController {

    protected $profiles;
    protected $imageHandler;

    public function __construct(ProfilesRepository $profiles, ImageHandler $imageHandler)
    {
        parent::__construct();
        $this->imageHandler = $imageHandler;
        $this->profiles = $profiles;
    }

    public function index()
    {
        return view('word-lid.index');
    }

    public function becomeMember()
    {
        // if user already is a member, show some message
        // if user isn't member but has registered, do stuff
        // else show registration / login form

        $activeStep = '';

        // Create steps of form
        $steps = [
            'login-or-register' => [
                'text' => '1. Inloggen of registreren',
                'active' => !Auth::check()
            ],
            'become-member' => [
                'text' => '2. Gegevens invullen',
                'active' => Permission::has('user.become-member')
            ],
            'all-done' => [
                'text' => '3. Klaar!',
                'active' => Auth::check() && Auth::user()->isPotential()
            ]
        ];

        // Find the active step
        foreach($steps as $key=>$value)
        {
            if($steps[$key]['active'])
            {
                $activeStep = $key;
                break;
            }
        }

        return view('word-lid.word-lid')
            ->with('steps', $steps)
            ->with('activeStep', $activeStep);
    }

    public function store(Request $request, PotentialValidator $validator)
    {
        $data = $request->only(['firstname','middlename','lastname','gender','birth-day','birth-month','birth-year',
            'address','zip-code','town','email','phone','study-start-year','study','student-number','username',
            'password','password_confirmation','parents-same-address','parents-address','parents-email','parents-phone',
            'additional-information']);

        // Construct a date from separate day, month and year fields.
        $data['birthdate'] = $data['birth-year'] . '-' . $data['birth-month'] . '-' . $data['birth-day'];

        // Check if parent address is the same as potential address
        if ($request->get('parents-same-address', '0') == '1')
        {
            $data['parents-address'] = $data['address'];
            $data['parents-town'] = $data['town'];
            $data['parents-zip-code'] = $data['zip-code'];
        }

        $validator->validate($data);

        if(Auth::attempt($request->only('email', 'password')))
        {
            // Only allow visitors here.
            if(! Auth::user()->isVisitor)
                throw new ValidationException(new MessageBag(['user' => 'Je hebt je al aangemeld']));

            // Promote this guest to potential
            $this->dispatchFromArray(PromoteGuestToPotential::class, $data);

        } else {
            $user = $this->dispatchFromArray(SignUpAsPotential::class, $data);

            Auth::loginUsingId($user->id);
        }

        // Redirect to the become-member page which shows some congrats page
//        return redirect()->action('MemberController@becomeMember');
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
        if ( Auth::user()->profile->id !== $profile_id && ! Permission::has('users.show') )
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