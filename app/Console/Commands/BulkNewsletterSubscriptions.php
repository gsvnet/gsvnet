<?php namespace GSV\Console\Commands;

use GSVnet\Newsletters\NewsletterList;
use GSVnet\Users\User;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserTransformer;
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
        'oud-leden' => User::FORMERMEMBER
    ];

    /**
     * BulkNewsletterSubscriptions constructor.
     * @param NewsletterList $newsletterList
     * @param UserTransformer $userTransformer
     * @param UsersRepository $users
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

        if (!array_key_exists($for, $this->values)) {
            $this->error('Kies uit leden of oud-leden');
            return;
        }

        $type = $this->values[$for];
        
        $users = $this->users->getAllVerifiedByType($type);

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
            ['for', InputArgument::REQUIRED, 'Wie moeten er geupdate worden? leden|oud-leden '],
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
