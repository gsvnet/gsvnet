<?php namespace GSVnet\Users;

use Illuminate\Support\Collection;

class UserTransformer {

    /**
     * @param User $user
     * @return array
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    public function mailchimpSubscribe(User $user)
    {
        return [
            'FNAME' => $user->firstname,
            'LNAME' => $user->present()->fullLastname,
            'TITEL' => $user->profile ? ($user->profile->gender == 1 ? 'Amice' : 'Amica') : ''
        ];
    }

    /**
     * @param Collection $users
     * @return array
     */
    public function batchMailchimpSubscribe(Collection $users)
    {
        $batch = [];

        foreach($users as $user)
        {
            $batch[] = [
                'email' => ['email' => $user->email],
                'merge_vars' => $this->mailchimpSubscribe($user)
            ];
        }

        return $batch;
    }

    /**
     * @param User $user
     * @return array
     */
    public function mailchimpUnsubscribe(User $user)
    {
        return [
            ['email' => $user->email]
        ];
    }

    /**
     * @param Collection $users
     * @return array
     */
    public function batchMailchimpUnsubscribe(Collection $users)
    {
        $batch = [];
        foreach($users as $user)
        {
            $batch[] = $this->mailchimpUnsubscribe($user);
        }

        return $batch;
    }
}