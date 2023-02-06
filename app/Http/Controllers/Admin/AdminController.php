<?php

namespace Admin;

use Illuminate\Http\Request;

class AdminController extends AdminBaseController
{
    public function index()
    {
        return view('admin.index');
    }

    public function redirectToMyProfile(Request $request)
    {
        return redirect()->action('Admin\UsersController@show', $request->user()->id);
    }
}
