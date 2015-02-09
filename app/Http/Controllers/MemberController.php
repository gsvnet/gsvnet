<?php

use GSVnet\Permissions\Permission;
use GSVnet\Users\UserManager;
use GSVnet\Users\Profiles\ProfileManager;
use GSVnet\Users\Profiles\ProfilesRepository;

use GSVnet\Core\ImageHandler;

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
                'active' => Auth::check() && Auth::user()->type == 'potential'
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

    public function store(ProfileManager $profileManager)
    {
        $user = Auth::user();
        $input = Input::except(['photo_path']);
        $input['photo_path'] = null;

        if (Input::hasFile('photo_path'))
        {
            $input['photo_path'] = Input::file('photo_path');
        }

        // Construct a date from separate day, month and year fields.
        $input['potential-birthdate'] = $input['potential-birth-year'] . '-' . $input['potential-birth-month'] . '-' . $input['potential-birth-day'];

        // Check if parent address is the same as potential address
        if (Input::get('parents-same-address', '0') == '1')
        {
            $input['parents-address'] = $input['potential-address'];
            $input['parents-town'] = $input['potential-town'];
            $input['parents-zip-code'] = $input['potential-zip-code'];
        }

        // Create the profile and attach it to the user
        $profileManager->create($user, $input);

        // Redirect to the become-member page: it shows the 3rd step [done] as active page
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