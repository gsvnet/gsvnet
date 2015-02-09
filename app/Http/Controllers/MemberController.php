<?php

use GSVnet\Users\UserManager;
use GSVnet\Users\Profiles\ProfileManager;
use GSVnet\Users\Profiles\ProfilesRepository;

use GSVnet\Core\ImageHandler;

class MemberController extends BaseController {

    protected $userManager;
    protected $profileManager;
    protected $profiles;
    protected $imageHandler;

    public function __construct(
        UserManager $userManager,
        ProfilesRepository $profiles,
        ProfileManager $profileManager,
        ImageHandler $imageHandler)
    {
        parent::__construct();
        $this->userManager = $userManager;
        $this->profileManager = $profileManager;
        $this->profiles = $profiles;
        $this->imageHandler = $imageHandler;
    }

    public function index()
    {
        $this->layout->bodyID = 'become-member-index-page';
        $this->layout->activeMenuItem = 'lid-worden';
        $this->layout->activeSubMenuItem = 'lid-worden';
        $this->layout->content = View::make('word-lid.index');
    }

    public function becomeMember()
    {
        // if user allready is a member, show some message

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

        $this->layout->bodyID = 'become-member-page';
        $this->layout->title = 'Lid worden!';
        $this->layout->description = 'Wil jij een vereniging waar het geloof een centrale rol speelt, een vereniging met vele toffe, diverse activiteiten en weekenden en waar je vrienden voor het leven maakt? Meld je aan!';
        $this->layout->activeMenuItem = 'lid-worden';
        $this->layout->activeSubMenuItem = 'inschrijven';
        $this->layout->content = View::make('word-lid.word-lid')
            ->with('steps', $steps)
            ->with('activeStep', $activeStep);
    }

    public function store()
    {
        $user = Auth::user();
        $input = Input::except(['photo_path']);

        if (Input::hasFile('photo_path'))
        {
            $input['photo_path'] = Input::file('photo_path');
        } else {
            $input['photo_path'] = null;
        }

        // Construct a date from seperate day, month and year fields.
        $input['potential-birthdate'] = $input['potential-birth-year'] . '-' . $input['potential-birth-month'] . '-' . $input['potential-birth-day'];

        // Check if parent address is the same as potential address
        if (Input::get('parents-same-address', '0') == '1')
        {
            $input['parents-address']   = $input['potential-address'];
            $input['parents-town']      = $input['potential-town'];
            $input['parents-zip-code']  = $input['potential-zip-code'];
        }

        // Create the profile and attach it to the user
        $profile = $this->profileManager->create($user, $input);

        // Redirect to the become-member page: it shows the 3rd step [done] as active page
        return Redirect::action('MemberController@becomeMember');
    }

    public function faq()
    {
        $this->layout->bodyID = 'faq-page';
        $this->layout->title = 'Veelgestelde vragen!';
        $this->layout->description = 'Wat je moet weten over de studentenvereniging GSV';
        $this->layout->activeMenuItem = 'lid-worden';
        $this->layout->activeSubMenuItem = 'faq';
        $this->layout->content = View::make('word-lid.faq');
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

        return Response::inlinePhoto($path, $name);
    }
}