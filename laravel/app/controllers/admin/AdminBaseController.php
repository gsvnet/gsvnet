<?php namespace Admin;

class AdminBaseController extends \BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'layouts.admin';
        \Former::framework('TwitterBootstrap3');
    }
}