<?php

namespace GSV\Console\Commands;

use AlgoliaSearch\Client as AlgoliaClient;
use GSVnet\Users\MemberTransformer;
use GSVnet\Users\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

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
        $users = User::with('profile.yearGroup')->whereIn('type', [User::FORMERMEMBER, User::MEMBER])->get();

        $transformer = new MemberTransformer;

        $formattedList = $users->map(function (User $user) use ($transformer) {
            try {
                $formatted = $transformer->transform($user);
                $formatted['yeargroup'] = $transformer->includeYearGroup($user);
                return $formatted;
            } catch (\Exception $e) {
                return null;
            }
        })->filter();

        $index->addObjects($formattedList->all(), 'id');
    }
}