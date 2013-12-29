<?php namespace Admin;

use View;
use Model\Album;
use Model\Photo;
use Input;
use Validator;
use Str;
use Redirect;

class AdminController extends BaseController {

    public function index()
    {
        $this->layout->content =  View::make('admin.index');
    }
}