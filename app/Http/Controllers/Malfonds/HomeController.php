<?php

namespace Malfonds;

use Auth;
use Illuminate\Http\Response;

class HomeController extends MalfondsController
{
    public function home(): Response
    {
        return response()->json([
            'welkom' => Auth::user()->present()->fullName(),
        ]);
    }
}
