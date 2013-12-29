<?php namespace Admin;

use View;
use Model\Album;
use Model\Photo;
use Input;
use Validator;
use Str;
use Redirect;

class BaseController extends \BaseController {

    public function __construct()
    {
        $this->layout = 'layouts.admin';
    }
}