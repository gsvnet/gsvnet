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
        ProfileManager $profileManger,
        ImageHandler $imageHandler)
    {
        parent::__construct();
        $this->userManager = $userManager;
        $this->profileManger = $profileManger;
        $this->profiles = $profiles;
        $this->imageHandler = $imageHandler;
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
        $this->layout->activeMenuItem = 'lid-worden';
        $this->layout->content = View::make('word-lid.word-lid')
            ->with('steps', $steps)
            ->with('activeStep', $activeStep);
    }

    public function store()
    {
        $user = Auth::user();
        $input = Input::except(['potential-image']);

        if (Input::hasFile('potential-image'))
        {
            $input['photo'] = Input::file('potential-image');
        }

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

    // Show original (resized) photo
    public function showPhoto($profile_id)
    {
        return $this->photoResponse($profile_id);
    }
    /**
    *
    *   Returns an image response
    *
    *   @param int $id
    *   @param string $type ('', 'small', or 'wide')
    */
    private function photoResponse($id)
    {
        $profile    = $this->profiles->byId($id);
        $image      = $this->imageHandler->get($profile->photo_path);
        $response   = $image->response();

        $path = $this->imageHandler->getStoragePath($profile->photo_path);
        $name = $profile->user->full_name;

         if (is_null($name)) {
            $name = basename($path);
        }

        $filetime = filemtime($path);
        $etag = md5($filetime . $path);
        $time = gmdate('r', $filetime);
        // Keep images 1 month
        $lifetime = 60*60*24*30;
        $expires = gmdate('r', $filetime + $lifetime);
        // $expires = '+1 month';
        $length = filesize($path);

        $headers = array(
            'Content-Disposition' => 'inline; filename="' . $name . '"',
            'Last-Modified' => $time,
            'Cache-Control' => 'must-revalidate',
            'Expires' => $expires,
            'Pragma' => 'public',
            'Etag' => $etag,
        );
        $headerTest1 = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && $_SERVER['HTTP_IF_MODIFIED_SINCE'] == $time;
        $headerTest2 = isset($_SERVER['HTTP_IF_NONE_MATCH']) && str_replace('"', '', stripslashes($_SERVER['HTTP_IF_NONE_MATCH'])) == $etag;
        //image is cached by the browser, we dont need to send it again
        if ($headerTest1 || $headerTest2) {
            return Response::make('', 304, $headers);
        }

        foreach ($headers as $header => $value) {
            $response->header($header, $value);
        }

        return $response;
    }
}