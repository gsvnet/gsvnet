<?php namespace GSV\Helpers\Newsletters;

use GSV\Helpers\Users\User;
use GSV\Helpers\Users\UserTransformer;
use Illuminate\Support\Facades\Config;
use Queue, App, Log;

class NewsletterManager {

    protected $userTransformer;

    function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    public function userUpdated(User $old, User $new)
    {
        if($old->type == $new->type && $old->email == $new->email)
        {
            return;
        }

        if(Config::get('app.debug'))
        {
            return;
        }

        // Remove old user from mailing lists
        if($old->wasOrIsMember())
        {
            Queue::push('GSV\Helpers\Newsletters\NewsletterManager@removeUserFromMailingList', [
                'list' => $old->type,
                'email' => $old->email
            ]);
        }

        // Add to mailing lists
        if($new->isMemberOrReunist())
        {
            $data = [
                'list' => $new->type,
                'email' => $new->email,
                'user' => $this->userTransformer->mailchimpSubscribe($new)
            ];

            Queue::push('GSV\Helpers\Newsletters\NewsletterManager@addUserToMailingList', $data);
        }
    }

    public function forgetUser(User $user)
    {
        if ($user->wasOrIsMember()) {
            Queue::push('GSV\Helpers\Newsletters\NewsletterManager@removeUserFromMailingList', [
                'list' => $user->type,
                'email' => $user->email
            ]);
        }
    }

    public function removeUserFromMailingList($job, $data)
    {
        try {
            App::make('GSV\Helpers\Newsletters\NewsletterList')->unsubscribeFrom($data['list'], $data['email']);
        } catch(\Mailchimp_Error $e) {
            echo "Mailchimp error; contact the webcie";
        }

        $job->delete();
    }

    public function addUserToMailingList($job, $data)
    {
        try {
            App::make('GSV\Helpers\Newsletters\NewsletterList')->subscribeTo($data['list'], $data['email'], $data['user']);
        } catch(\Mailchimp_Error $e) {
            echo "Mailchimp error; contact the webcie";
        }

        $job->delete();
    }
} 