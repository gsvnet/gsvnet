<?php

namespace Admin;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends AdminBaseController
{
    public function index(): View
    {
        return view('admin.index');
    }

    public function redirectToMyProfile(Request $request): RedirectResponse
    {
        return redirect()->action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $request->user()->id);
    }
}
