<?php

namespace App\Helpers\Newsletters;

use App;
use App\Helpers\Users\User;
use App\Helpers\Users\UserTransformer;
use Illuminate\Support\Facades\Config;
use Queue;

class NewsletterManager
{
    protected $userTransformer;

    public function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    public function userUpdated(User $old, User $new)
    {
        if ($old->type == $new->type && $old->email == $new->email) {
            return;
        }

        if (Config::get('app.debug')) {
            return;
        }

        // Remove old user from mailing lists
        if ($old->wasOrIsMember()) {
            Queue::push('App\Helpers\Newsletters\NewsletterManager@removeUserFromMailingList', [
                'list' => $old->type,
                'email' => $old->email,
            ]);
        }

        // Add to mailing lists
        if ($new->isMemberOrReunist()) {
            $data = [
                'list' => $new->type,
                'email' => $new->email,
                'user' => $this->userTransformer->mailchimpSubscribe($new),
            ];

            Queue::push('App\Helpers\Newsletters\NewsletterManager@addUserToMailingList', $data);
        }
    }

    public function forgetUser(User $user)
    {
        if ($user->wasOrIsMember()) {
            Queue::push('App\Helpers\Newsletters\NewsletterManager@removeUserFromMailingList', [
                'list' => $user->type,
                'email' => $user->email,
            ]);
        }
    }

    public function removeUserFromMailingList($job, $data)
    {
        try {
            App::make(\App\Helpers\Newsletters\NewsletterList::class)->unsubscribeFrom($data['list'], $data['email']);
        } catch (\Mailchimp_Error $e) {
            echo 'Mailchimp error; contact the webcie';
        }

        $job->delete();
    }

    public function addUserToMailingList($job, $data)
    {
        try {
            App::make(\App\Helpers\Newsletters\NewsletterList::class)->subscribeTo($data['list'], $data['email'], $data['user']);
        } catch (\Mailchimp_Error $e) {
            echo 'Mailchimp error; contact the webcie';
        }

        $job->delete();
    }
}
