<?php namespace Admin;

use Controller;
use Former;

class AdminBaseController extends Controller {

    public function __construct()
    {
        Former::framework('TwitterBootstrap3');
    }
}