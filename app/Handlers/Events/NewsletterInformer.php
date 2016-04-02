<?php namespace GSV\Handlers\Events;

use GSV\Events\Members\ProfileEvent;
use GSVnet\Newsletters\NewsletterList;
use GSVnet\Users\UserTransformer;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * NewsletterInformer constructor.
     * @param NewsletterList $newsletterList
     * @param UserTransformer $transformer
     */
    public function __construct(NewsletterList $newsletterList, UserTransformer $transformer)
    {
        $this->list = $newsletterList;
        $this->transformer = $transformer;
    }

    public function handle(ProfileEvent $event)
    {
        $user = $event->getUser();

        // Add to mailing lists
        if ($user->wasOrIsMember()) {
            $data = $this->transformer->mailchimpSubscribe($user);
            try {
                $this->list->subscribeTo($user->type, $user->email, $data);
            } catch (\Mailchimp_Error $e) {
                // simply ignore MailChimp errors for now.
            }
        }
    }
}