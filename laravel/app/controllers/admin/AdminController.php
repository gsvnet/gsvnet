<?php namespace Admin;

use BaseController;
use View;
use Model\Album;
use Model\Photo;
use Input;
use Validator;
use Str;
use Redirect;

class AdminController extends BaseController {

    public function __construct()
    {
        $this->layout = 'layouts.admin';
    }
}