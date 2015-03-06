<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    protected $tables = [
        'activity',
        'albums',
        'comment_tag',
        'comments',
        'committee_user',
        'committees',
        'events',
        'failed_jobs',
        'family_relations',
        'file_label',
        'files',
        'forum_replies',
        'forum_thread_visitations',
        'forum_threads',
        'labels',
        'likeable_likes',
        'migrations',
        'password_reminders',
        'photos',
        'senates',
        'tagged_items',
        'tags',
        'user_profiles',
        'user_senate',
        'users',
        'year_groups'
    ];

    protected $seeders = [
        'CommitteesTableSeeder',
        'YearGroupsSeeder',
        'UsersTableSeeder',
        'EventsTableSeeder',
        'UserCommitteeSeeder',
        'LabelsTableSeeder',
        'AlbumsTableSeeder',
        'PhotosTableSeeder',
        'SenatesTableSeeder',
        'BetaTestersTableSeeder',
        'TagSeeder',
        'ForumTableSeeder'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->truncateTables();
        $this->seedTables();
    }

    protected function truncateTables()
    {
        foreach ($this->tables as $tableName)
        {
            DB::table($tableName)->truncate();
        }
    }

    protected function seedTables()
    {
        foreach ($this->seeders as $seeder)
        {
            $this->call($seeder);
        }
    }
}