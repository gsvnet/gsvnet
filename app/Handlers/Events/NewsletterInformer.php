<?php namespace GSV\Handlers\Events;

use GSV\Events\Members\MembershipStatusWasChanged;
use GSV\Events\Members\ProfileEvent;
use GSV\Helpers\Newsletters\NewsletterList;
use GSV\Helpers\Newsletters\NewsletterManager;
use GSV\Helpers\Users\User;
use GSV\Helpers\Users\UserTransformer;
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
            if (in_array($event->getOldStatus(), [User::MEMBER, User::REUNIST, User::EXMEMBER]))
                $this->list->unsubscribeFrom($event->getOldStatus(), $user->email);
        }

        // Add to mailing lists
        if ($user->isMemberOrReunist() && $user->profile && $user->profile->alive) {
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
