<?php namespace Malfonds;

use Auth;

class HomeController extends MalfondsController
{
    public function home()
    {
        var_dump(Auth::user());
        if(Auth::check()) {
            return 'Welkom ' . Auth::user()->present()->fullName();
        }

        return 'Welkom';
    }
}