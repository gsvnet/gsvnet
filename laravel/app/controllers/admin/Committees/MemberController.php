<?php namespace Admin\Committees;

use Admin\BaseController;
use Input, View;

class MemberController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

    public function store()
    {
        $input = Input::all();
    }

    public function edit($committee)
    {
        dd($committee);
    }

    public function updte($committee)
    {
        dd($committee);
    }
}