<?php

namespace GSV\Console\Commands;

use Illuminate\Console\Command;
use GSV\Commands\Members\ChangeMembershipStatus;
use GSVnet\Users\User;
use GSVnet\Users\Profiles\UserProfile;
use GSVnet\Users\UsersRepository;
use GSVnet\Committees\CommitteesRepository;
use GSVnet\Committees\CommitteeMembership\CommitteeMembershipRepository;
use haampie\Gravatar\Gravatar;
use GSVnet\Core\DispatchesJobs;

class RegionsToCommittees extends Command
{
    use DispatchesJobs;
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'regions:tocommittees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Temporary command to assign all members of old regions (1-4) to committees with the same name.';


    public function __construct(UsersRepository $users, CommitteesRepository $committees, CommitteeMembershipRepository $committeeMembership)
    {
        parent::__construct();
        $this->users = $users;
        $this->committees = $committees;
        $this->committeeMembership = $committeeMembership;
    }

    public function handle()
    {
        for($i = 1; $i <= 4; $i++) {
            $this->info("\nRegio {$i}");
            // Create the new committees
            $regio = $this->committees->create([
                'name' => "Regio {$i}",
                'unique_name' => "regio{$i}",
                'description' => "Regio {$i} van de oude regio-indeling",
                'public' => false
            ]);

            // Find users by region
            $query = UserProfile::with('user', 'yearGroup')->join('users', function($join) {
                $join->on('users.id', '=', 'user_profiles.user_id');
            });
            $members = $query->where('region', '=', $i)->get();

            $bar = $this->output->createProgressBar(count($members));
            foreach($members as $member) {
                $this->committeeMembership->create($member->user, $regio, ['start_date' => '2018-06-05','end_date' => '2018-06-05']);
                $bar->advance();
            }
            $bar->finish();
        }        
    }
}