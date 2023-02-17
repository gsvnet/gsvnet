<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
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
        'invitation_tokens',
        'labels',
        'likeable_likes',
        'malfonds_invites',
        'password_reminders',
        'photos',
        'profile_actions',
        'regions',
        'region_user_profile',
        'senates',
        'tagged_items',
        'tags',
        'user_profiles',
        'user_senate',
        'users',
        'year_groups',
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
        'TagSeeder',
        'ForumTableSeeder',
        'AdminUserSeeder',
        'RegionsTableSeeder',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        $this->truncateTables();
        $this->seedTables();
    }

    protected function truncateTables()
    {
        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }
    }

    protected function seedTables()
    {
        foreach ($this->seeders as $seeder) {
            $timeStart = microtime(true);
            $this->call($seeder);
            $timeEnd = microtime(true);

            $duration = $timeEnd - $timeStart;

            $this->command->info("Duration: {$duration}s");
        }
    }
}
