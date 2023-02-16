<?php

namespace App\Helpers\Newsletters\Mailchimp;

use App\Helpers\Newsletters\NewsletterList as NewsletterListInterface;
use Illuminate\Contracts\Config\Repository;
use MailchimpMarketing\ApiClient;

class NewsletterList implements NewsletterListInterface
{
    protected $mailchimp;

    protected $lists = [];

    public function __construct(ApiClient $mailchimp, Repository $config)
    {
        $this->mailchimp = $mailchimp;
        $this->lists = $config->get('mailchimp.lists');
        $mailchimp->setConfig([
            'apiKey' => $config->get('mailchimp.key'),
            'server' => $config->get('mailchimp.server'),
        ]);
    }

    /**
     * @param $listName
     * @param $email
     * @param $vars
     * @return mixed
     */
    public function subscribeTo($listName, $email, $vars = [])
    {
        if (! array_key_exists($listName, $this->lists)) {
            return null;
        }

        return $this->mailchimp->lists->addListMember(
            $this->lists[$listName],
            ['email_address' => $email,
                'status' => 'pending',
                'merge_fields' => $vars, // merge vars,
                'email_type' => 'html', // email type
            ]
        );
    }

    /**
     * @param $listName
     * @param $email
     * @return mixed
     */
    public function unsubscribeFrom($listName, $email)
    {
        if (! array_key_exists($listName, $this->lists)) {
            return null;
        }

        return $this->mailchimp->lists->deleteListMember(
            $this->lists[$listName],
            md5(strtolower($email)),
        );
    }

    /**
     * @param $listname
     * @param $batch
     * @return mixed
     */
    public function handleBatch($listname, $batch)
    {
        if (! array_key_exists($listname, $this->lists)) {
            return null;
        }

        return $this->mailchimp->lists->batchListMembers(
            $this->lists[$listname],
            ['members' => $batch,
                'skip_duplicate_check' => true, // replace existing
            ]);
    }
}
