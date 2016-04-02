<?php namespace GSVnet\Newsletters\Mailchimp;

use GSVnet\Newsletters\NewsletterList as NewsletterListInterface;
use Illuminate\Contracts\Config\Repository;
use Mailchimp;

class NewsletterList implements NewsletterListInterface
{

    protected $mailchimp;

    protected $lists = [];

    /**
     * @param Mailchimp $mailchimp
     * @param Repository $config
     */
    function __construct(Mailchimp $mailchimp, Repository $config)
    {
        $this->mailchimp = $mailchimp;
        $this->lists = $config->get('mailchimp.lists');
    }

    /**
     * @param $listName
     * @param $email
     * @param $vars
     * @return void
     */
    public function subscribeTo($listName, $email, $vars = [])
    {
        if (!array_key_exists($listName, $this->lists))
            return;

        $this->mailchimp->lists->subscribe(
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
     * @return void
     */
    public function unsubscribeFrom($listName, $email)
    {
        if (!array_key_exists($listName, $this->lists))
            return;
        
        $this->mailchimp->lists->unsubscribe(
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
     * @return void
     */
    public function batchSubscribeTo($listname, $batch)
    {
        if (!array_key_exists($listname, $this->lists))
            return;
        
        $this->mailchimp->lists->batchSubscribe(
            $this->lists[$listname],
            $batch,
            false,// double opt in
            true // replace existing
        );
    }

    /**
     * @param $listname
     * @param $batch
     * @return void
     */
    public function batchUnsubscribeFrom($listname, $batch)
    {
        if (!array_key_exists($listname, $this->lists))
            return;
        
        $this->mailchimp->lists->batchUnsubscribe(
            $this->lists[$listname],
            $batch,
            false, // delete
            false, // goodbye
            false // notification
        );
    }


}