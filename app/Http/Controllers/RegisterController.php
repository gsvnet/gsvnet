<?php

use GSVnet\Users\UserManager;

class RegisterController extends BaseController {

    public function create()
    {
        return view('users.register');
    }

    public function store(UserManager $userManager)
    {
        $input = Input::all();

        // Let the user be a visitor
        $input['type'] = 0;

        // Let the user manager handle validation, creation and emails
        $user = $userManager->create($input);

        // Log the user immediately in
        Auth::login($user);

        // Potentials should return to the become member form
        if (Input::has('become-member-register'))
            return redirect()->action('MemberController@becomeMember');

        return redirect('/');
    }
}