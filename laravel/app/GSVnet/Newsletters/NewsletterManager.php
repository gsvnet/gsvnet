<?php namespace GSVnet\Newsletters;

use GSVnet\Users\User;
use GSVnet\Users\UserTransformer;
use Queue, App;

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

        // Remove old user from mailing lists
        if($old->wasOrIsMember())
        {
            Queue::push('GSVnet\Newsletters\NewsletterManager@removeUserFromMailingList', [
                'list' => $old->type,
                'email' => $old->email
            ]);
        }

        // Add to mailing lists
        if($new->wasOrIsMember())
        {
            $data = [
                'list' => $new->type,
                'email' => $new->email,
                'user' => $this->userTransformer->mailchimpSubscribe($new)
            ];

            Queue::push('GSVnet\Newsletters\NewsletterManager@addUserToMailingList', $data);
        }
    }

    public function removeUserFromMailingList($job, $data)
    {
        try {
            App::make('GSVnet\Newsletters\NewsletterList')->unsubscribeFrom($data['list'], $data['email']);
        } catch(\Mailchimp_Error $e) {
            Log::info($e->getMessage());
        }
    }

    public function addUserToMailingList($job, $data)
    {
        try {
            App::make('GSVnet\Newsletters\NewsletterList')->subscribeTo($data['list'], $data['email'], $data['user']);
        } catch(\Mailchimp_Error $e) {
            Log::info($e->getMessage());
        }
    }
} 