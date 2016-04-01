<?php namespace Admin;

class AdminController extends AdminBaseController {

    public function index()
    {
        return view('admin.index');
    }
}