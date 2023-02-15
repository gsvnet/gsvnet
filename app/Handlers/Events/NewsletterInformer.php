<?php

namespace App\Handlers\Events;

use App\Events\Members\MembershipStatusWasChanged;
use App\Events\Members\ProfileEvent;
use App\Helpers\Newsletters\NewsletterList;
use App\Helpers\Users\User;
use App\Helpers\Users\UserTransformer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Log\Logger;

class NewsletterInformer implements ShouldQueue
{
    /**
     * @var NewsletterList
     */
    protected $list;

    /**
     * @var UserTransformer
     */
    private $transformer;

    /**
     * @var Logger
     */
    private $log;

    /**
     * NewsletterInformer constructor.
     *
     * @param  NewsletterList  $newsletterList
     * @param  UserTransformer  $transformer
     * @param  Logger  $log
     */
    public function __construct(NewsletterList $newsletterList, UserTransformer $transformer, Logger $log)
    {
        $this->list = $newsletterList;
        $this->transformer = $transformer;
        $this->log = $log;
    }

    public function handle(ProfileEvent $event)
    {
        $user = $event->getUser();

        // Remove from old mailing lists if necessary
        if ($event instanceof MembershipStatusWasChanged) {
            if (in_array($event->getOldStatus(), [User::MEMBER, User::REUNIST, User::EXMEMBER])) {
                $this->list->unsubscribeFrom($event->getOldStatus(), $user->email);
            }
        }

        // Add to mailing lists
        if ($user->isMemberOrReunist() && $user->profile && $user->profile->alive) {
            $data = $this->transformer->mailchimpSubscribe($user);
            try {
                $this->list->subscribeTo($user->type, $user->email, $data);
            } catch (\Mailchimp_Error $e) {
                $this->log->error('Something has gone wrong when accessing MailChimp: '.$e->getMessage());
                // simply ignore MailChimp errors for now.
            }
        }
    }
}
