<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use GSVnet\Users\User;
use GSVnet\Users\UserTransformer;
use GSVnet\Newsletters\NewsletterList;

class BulkNewsletterSubscriptions extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'newsletter:update-subscriptions';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update newsletter subscriptions.';

    protected $newsletterlist;
    protected $userTransformer;

    private $values = [
        'leden' => User::MEMBER,
        'oud-leden' => User::FORMERMEMBER
    ];

    public function __construct(NewsletterList $newsletterList, UserTransformer $userTransformer)
	{
		parent::__construct();
        $this->newsletterlist = $newsletterList;
        $this->userTransformer = $userTransformer;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $for = $this->argument('for');

        if(! array_key_exists($for, $this->values))
        {
            $this->error('Kies uit leden of oud-leden');
            return;
        }

        $type = $this->values[$for];

        $users = User::where('type', '=', $type)->get();

        $unsubscribeBatch = $this->userTransformer->batchMailchimpUnsubscribe($users);
        $subscribeBatch = $this->userTransformer->batchMailchimpSubscribe($users);

        try {
            $this->newsletterlist->batchUnsubscribeFrom($this->values['leden'], $unsubscribeBatch);
        } catch(\Mailchimp_Error $e) {}

        try {
            $this->newsletterlist->batchUnsubscribeFrom($this->values['oud-leden'], $unsubscribeBatch);
        } catch(\Mailchimp_Error $e) {}

        try {
            $this->newsletterlist->batchSubscribeTo($type, $subscribeBatch);
        } catch(\Mailchimp_Error $e) {}

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			array('for', InputArgument::REQUIRED, 'Wie moeten er geupdate worden? leden|oud-leden '),
        ];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
        return [];
	}

}
