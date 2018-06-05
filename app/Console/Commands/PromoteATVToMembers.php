<?php

namespace GSV\Console\Commands;

use Illuminate\Console\Command;
use GSV\Commands\Members\ChangeMembershipStatus;
use GSVnet\Users\User;
use GSVnet\Users\Profiles\UserProfile;
use GSVnet\Users\UsersRepository;
use haampie\Gravatar\Gravatar;
use GSVnet\Core\DispatchesJobs;

class PromoteATVToMembers extends Command
{
    use DispatchesJobs;
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'atv:promote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Temporary command to promote all ATV members to full members.';


    public function __construct(UsersRepository $users)
    {
        parent::__construct();
        $this->users = $users;
    }

    public function handle()
    {
        $menCounter = 0;
        $womenCounter = 100;

        $users = $this->users->getAllByType(User::ATV);
        if (!$this->confirm('Wil je alle ' . count($users) . ' ATV\'ers veranderen in potentials?')) {
            return;
        }

        $bar = $this->output->createProgressBar(count($users));

        foreach ($users as $user) {    
            // Create empty user profile
            $profile = new UserProfile();
    
            $user->profile()->save($profile);

            $this->dispatch(new ChangeMembershipStatus(User::MEMBER, $user, User::first()));

            $bar->advance();
        }

        $bar->finish();
    }
}