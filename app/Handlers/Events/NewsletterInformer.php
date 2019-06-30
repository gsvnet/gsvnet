<?php namespace GSV\Handlers\Events;

use GSV\Events\Members\MembershipStatusWasChanged;
use GSV\Events\Members\ProfileEvent;
use GSVnet\Newsletters\NewsletterList;
use GSVnet\Newsletters\NewsletterManager;
use GSVnet\Users\User;
use GSVnet\Users\UserTransformer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Log\Writer;

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
     * @var Writer
     */
    private $log;

    /**
     * NewsletterInformer constructor.
     * @param NewsletterList $newsletterList
     * @param UserTransformer $transformer
     * @param Writer $log
     */
    public function __construct(NewsletterList $newsletterList, UserTransformer $transformer, Writer $log)
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
            if ($event->getOldStatus() == User::MEMBER || $event->getOldStatus() == User::FORMERMEMBER)
                $this->list->unsubscribeFrom($event->getOldStatus(), $user->email);
        }

        // Add to mailing lists
        if ($user->wasOrIsMember() && $user->profile && $user->profile->alive) {
            $data = $this->transformer->mailchimpSubscribe($user);
            try {
                $this->list->subscribeTo($user->type, $user->email, $data);
            } catch (\Mailchimp_Error $e) {
                $this->log->error('Something has gone wrong when accessing MailChimp: ' . $e->getMessage());
                // simply ignore MailChimp errors for now.
            }
        }
    }
}
