<?php

use App\Helpers\Users\UserManager;

class RegisterController extends BaseController {

    public function create()
    {
        return view('users.register');
    }

    public function store(UserManager $userManager)
    {
        $input = Input::all();

        // Very specific spam protection...
        if($input['register-firstname'] == $input['register-middlename'] && $input['register-middlename'] == $input['register-lastname'])
            return redirect('/');

        // Honeypot spam protection
        if ($input['website'] != '')
            return redirect('/');

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
