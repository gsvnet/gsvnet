<?php namespace Admin;

class BaseController extends \BaseController {

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'layouts.admin';
        \Former::framework('TwitterBootstrap3');
    }
}