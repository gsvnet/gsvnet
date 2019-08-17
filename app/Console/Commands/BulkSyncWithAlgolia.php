<?php

namespace GSV\Console\Commands;

use AlgoliaSearch\Client as AlgoliaClient;
use GSVnet\Users\MemberTransformer;
use GSVnet\Users\User;
use GSVnet\Users\YearGroupTransformer;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

class BulkSyncWithAlgolia extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'algolia:members';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize all members with algolia.';


    public function fire()
    {
        /** @var AlgoliaClient $algolia */
        $algolia = app(AlgoliaClient::class);
        $index = $algolia->initIndex('jaarbundel');

        /** @var Collection $users */
        $users = User::with('profile.yearGroup')->whereIn('type', [User::REUNIST, User::EXMEMBER, User::MEMBER])->get();

        $memberTransformer = new MemberTransformer;
        $yeargroupTransformer = new YearGroupTransformer;

        $formattedList = $users->map(function (User $member) use ($memberTransformer, $yeargroupTransformer) {
            try {
                $formatted = $memberTransformer->transform($member);
                $formatted['yeargroup'] = $yeargroupTransformer->transform($member->profile->yearGroup);
                return $formatted;
            } catch (Throwable $e) {
                return null;
            }
        })->filter();

        $index->addObjects($formattedList->all(), 'id');
    }
}