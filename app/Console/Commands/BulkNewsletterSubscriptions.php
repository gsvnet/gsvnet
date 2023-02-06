<?php

namespace App\Console\Commands;

use App\Helpers\Newsletters\NewsletterList;
use App\Helpers\Users\User;
use App\Helpers\Users\UsersRepository;
use App\Helpers\Users\UserTransformer;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class BulkNewsletterSubscriptions extends Command
{
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

    /**
     * @var NewsletterList
     */
    protected $newsletterList;

    /**
     * @var UserTransformer
     */
    protected $userTransformer;

    /**
     * @var UsersRepository
     */
    private $users;

    /**
     * @var array
     */
    private $values = [
        'leden' => User::MEMBER,
        'reünisten' => User::REUNIST,
    ];

    /**
     * BulkNewsletterSubscriptions constructor.
     *
     * @param  NewsletterList  $newsletterList
     * @param  UserTransformer  $userTransformer
     * @param  UsersRepository  $users
     */
    public function __construct(NewsletterList $newsletterList, UserTransformer $userTransformer, UsersRepository $users)
    {
        parent::__construct();
        $this->newsletterList = $newsletterList;
        $this->userTransformer = $userTransformer;
        $this->users = $users;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $for = $this->argument('for');

        if (! array_key_exists($for, $this->values)) {
            $this->error('Kies uit leden of reünisten');

            return;
        }

        $type = $this->values[$for];

        $users = $this->users->getAllVerifiedAndAliveByType($type);

//        $unsubscribeBatch = $this->userTransformer->batchMailchimpUnsubscribe($users);
        $subscribeBatch = $this->userTransformer->batchMailchimpSubscribe($users);

        try {
            $this->info(json_encode($this->newsletterList->batchSubscribeTo($type, $subscribeBatch)));
        } catch (\Mailchimp_Error $e) {
            $this->info($e->getMessage());
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['for', InputArgument::REQUIRED, 'Wie moeten er geupdate worden? leden|reünisten '],
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
