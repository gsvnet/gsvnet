<?php namespace Admin\Committees;

class MemberController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

    public function store()
    {
        $input = Input::all();
    }
}