<?php

class UserController extends BaseController {
    /**
     * Show current and former members
     */
    public function showUsers()
    {
        $memberlist = Model\User::whereIn('type', array(3,4))
                                ->with('profile.yearGroup')
                                ->orderBy('lastname')
                                ->paginate(10);
        $this->layout->content = View::make('users.index')
            ->with('members', $memberlist);
    }

    public function showUser($id)
    {
        $member = Model\User::with('profile.yearGroup', 'committeesSorted')->find($id);
        

        //dd($member);

        $this->layout->content = View::make('users.profile')
            ->with('member', $member);
    }
}