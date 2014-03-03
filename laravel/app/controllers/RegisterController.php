<?php

use GSVnet\Users\UserManager;

class RegisterController extends BaseController {

    protected $userManager;

    public function __construct(UserManager $userManager)
    {
        parent::__construct();
        $this->userManager = $userManager;
    }

    public function create()
    {
        $this->layout->bodyID = 'show-register';
        $this->layout->layout = View::make('users.register');
    }

    public function store()
    {
        $input = Input::all();

        // Let the user be a visitor
        $input['type'] = 0;

        // Let the user manager handle validation, creation and emails
        $user = $this->userManager->create($input);

        // Log the user immediately in
        Auth::login($user);

        // Potentials should return to the become member form
        if (Input::has('become-member-register'))
        {
            return Redirect::to(URL::action('MemberController@index') . '#lid-worden');
        }

        return Redirect::to('/');
    }
}