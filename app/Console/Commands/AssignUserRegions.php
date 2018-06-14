<?php

namespace GSV\Console\Commands;

use Illuminate\Console\Command;
use GSVnet\Users\User;
use GSVnet\Users\Profiles\UserProfile;
use GSVnet\Users\UsersRepository;
use GSVnet\Committees\CommitteesRepository;
use GSVnet\Committees\Committee;
use GSVnet\Committees\CommitteeMembership\CommitteeMembershipRepository;
use GSVnet\Core\DispatchesJobs;
use Illuminate\Database\Eloquent\Collection;

class AssignUserRegions extends Command
{
    use DispatchesJobs;
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'regions:assign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Temporary command to assign current regions from various sources into the new tables.';


    public function __construct(UsersRepository $users, CommitteesRepository $committees, CommitteeMembershipRepository $committeeMembership)
    {
        parent::__construct();
        $this->users = $users;
        $this->committees = $committees;
        $this->committeeMembership = $committeeMembership;
    }

    public function handle()
    {
        $members = User::whereIn('type', [User::FORMERMEMBER, User::MEMBER])->with('profile.yearGroup', 'profile.regions')->get();

        $bar = $this->output->createProgressBar(count($members));

        $regionCommittees = collect([]);

        //Get region committees
        for($i = 1; $i <= 4; $i++) {
            $suffix = $i == 4 ? 'IV' : $i;
            $regionCommittees->push(Committee::where('name', 'like', 'Regio ' . $suffix)->first());
        }

        // print_r($regionCommittees->last()->name);
        // echo "\n\n";
        
        foreach($members as $member) {
            $regions = [];

            if($member->profile->region) {
                $regions[] = $member->profile->region;
            }

            $regionCommittees->each(function($committee, $i) use ($member, $regions) {
                if($member->committees->contains($committee->id)) {
                    $regions[] = $i + 1;
                    echo "Member " . $member->firstname . " zit in commissie " . $committee->name . " (" . ($i + 1) . ").\n";
                }
            });

            $member->profile->regions()->sync($regions);
            $bar->advance();
        }
        $bar->finish();       
    }
}