<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Former;

class AdminBaseController extends Controller
{
    public function __construct()
    {
        Former::framework('TwitterBootstrap3');
    }
}
