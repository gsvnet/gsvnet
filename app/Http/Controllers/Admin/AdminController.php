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
        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $request->user()->id);
    }
}
