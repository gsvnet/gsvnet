<?php

use GSVnet\Users\User;
use GSVnet\Users\UsersRepository;
use haampie\Gravatar\Gravatar;

class AprilController extends BaseController {

  protected $users;

  public function __construct(UsersRepository $users) {
    $this->users = $users;
  }

  public function index() {
    $this->authorize('admin');

    return view('April');
  }

  public function initialise() {
    $this->authorize('admin');

    // The women avatar ids have, as I've decided in all my wisdom,
    // an offset of 100.
    $menCounter = 0;
    $womenCounter = 100;

    $users = User::with('profile.yearGroup')
            ->orderBy('lastname', 'ASC')
            ->orderBy('firstname', 'ASC')
            ->where('type', User::MEMBER)
            ->orWhere('type', User::INTERNAL_COMMITTEE)
            ->limit(60)
            ->get();

    foreach ($users as $user) {
      if(empty($user->profile)) continue;

      $url = Gravatar::image($user->email, 120, 'mm', null, null, true);
      // If Gravatar image is the standard image.
      if (md5(file_get_contents($url)) == 'bb7cdd7a7ae85633dad820f21a2115cb') {
        if ($user->profile->gender == 1)
          $user->april = $menCounter++;
        else
          $user->april = $womenCounter++;
      } else {
        $user->april = -1;
      }

      //print_r($user);
      print "Changed ".$user->firstname."(".$user->profile->gender.") to ".$user->april."<br>";

      $user->save();

      $menCounter = $menCounter % 100;
      $womenCounter = max($womenCounter % 200, 100);
    }

    redirect('home');
  }
}
