<?php

use GSVnet\Users\UserManager;
use GSVnet\Users\Profiles\ProfileManager;

class MemberController extends BaseController {

    protected $userManager;
    protected $profileManager;

    public function __construct(
        UserManager $userManager,
        ProfileManager $profileManger)
    {
        parent::__construct();
        $this->userManager = $userManager;
        $this->profileManger = $profileManger;
    }

    public function index()
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
        $this->layout->content = View::make('word-lid.word-lid')
            ->with('steps', $steps)
            ->with('activeStep', $activeStep);
    }

    public function store()
    {
        $user = Auth::user();
        $input = Input::all();

        // Construct a date from seperate day, month and year fields.
        $input['potential-birthdate'] = $input['potential-birth-year'] . '-' . $input['potential-birth-month'] . '-' . $input['potential-birth-day'];

        // Check if parent address is the same as potential address
        if (Input::get('parents-same-address', '0') == '1')
        {
            $input['parents-address'] = $input['potential-address'];
            $input['parents-town'] = $input['potential-town'];
            $input['parents-zip-code'] = $input['potential-zip-code'];
        }

        // Create the profile and attach it to the user
        $profile = $this->profileManger->create($user, $input);

        // Redirct to the become-member page: it shows the 3rd step [done] as active page
        return Redirect::action('MemberController@index');
    }

    public function why()
    {
        return 'Why not?';
    }
}