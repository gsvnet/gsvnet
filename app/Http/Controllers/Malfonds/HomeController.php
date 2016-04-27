<?php namespace Malfonds;

use Auth;

class HomeController extends MalfondsController
{
    public function home()
    {
        return response()->json([
            'welkom' => Auth::user()->present()->fullName()
        ]);
    }
}