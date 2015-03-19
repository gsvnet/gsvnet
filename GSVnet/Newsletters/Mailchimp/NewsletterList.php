<?php namespace GSVnet\Newsletters\Mailchimp;

use GSVnet\Newsletters\NewsletterList as NewsletterListInterface;
use GSVnet\Users\User;
use Mailchimp;

class NewsletterList implements NewsletterListInterface {

    protected $mailchimp;

    protected $lists = [
        User::MEMBER => 'c5f9a07ee4',
        User::FORMERMEMBER => 'f844adabde'
    ];

    /**
     * @param Mailchimp $mailchimp
     */
    function __construct(Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * @param $listName
     * @param $email
     * @param $vars
     * @return mixed
     */
    public function subscribeTo($listName, $email, $vars = [])
    {
        return $this->mailchimp->lists->subscribe(
            $this->lists[$listName],
            ['email' => $email],
            $vars, // merge vars,
            'html', // email type
            false, // double opt-in
            true // update existing
        );
    }

    /**
     * @param $listName
     * @param $email
     * @return mixed
     */
    public function unsubscribeFrom($listName, $email)
    {
        return $this->mailchimp->lists->unsubscribe(
            $this->lists[$listName],
            ['email' => $email],
            false, // delete
            false, // goodbye mail
            false // notification
        );
    }

    /**
     * @param $listname
     * @param $batch
     * @return mixed
     */
    public function batchSubscribeTo($listname, $batch)
    {
        return $this->mailchimp->lists->batchSubscribe(
            $this->lists[$listname],
            $batch,
            false,// double opt in
            true // replace existing
        );
    }

    /**
     * @param $listname
     * @param $batch
     * @return mixed
     */
    public function batchUnsubscribeFrom($listname, $batch)
    {
        return $this->mailchimp->lists->batchUnsubscribe(
            $this->lists[$listname],
            $batch,
            false, // delete
            false, // goodbye
            false // notification
        );
    }


}