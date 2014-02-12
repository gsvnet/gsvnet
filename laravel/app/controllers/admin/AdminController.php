<?php namespace Admin;

use View;
use Model\YearGroup;

class AdminController extends BaseController {

    public function index()
    {
        $yearGroups = YearGroup::all();

        $this->layout->content =  View::make('admin.index')
            ->withYearGroups($yearGroups);
    }
}