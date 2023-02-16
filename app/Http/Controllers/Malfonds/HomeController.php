<?php

namespace Malfonds;

use Illuminate\Http\Response;
use Auth;

class HomeController extends MalfondsController
{
    public function home(): Response
    {
        return response()->json([
            'welkom' => Auth::user()->present()->fullName(),
        ]);
    }
}
