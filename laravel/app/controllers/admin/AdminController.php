<?php namespace Admin;

use View;

class AdminController extends AdminBaseController {

    public function index()
    {
        $this->layout->content = View::make('admin.index');
    }
}