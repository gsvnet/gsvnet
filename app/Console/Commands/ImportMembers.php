<?php

namespace GSV\Console\Commands;

use GSVnet\Users\Profiles\UserProfile;
use GSVnet\Users\User;
use GSVnet\Users\UserPresenter;
use GSVnet\Users\YearGroup;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ImportMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'members:import {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import members';

    /**
     * @var Filesystem
     */
    private $files;

    private $yearToId;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
        $this->yearToId = YearGroup::all()->keyBy('year');
    }

    private function outputFromJSON(\stdClass $user)
    {
        $this->table(['Voornaam', 'Tussenvoegsel', 'Achternaam', 'Jaarverband'], [[
            $user->firstname,
            $user->middlename,
            $user->lastname,
            $this->yearToId[$user->year]->present()->nameWithYear,
        ]]);
    }

    /**
     * @param $user
     * @return User
     */
    private function createNewUser($user)
    {
        $newUser = new User([
            'firstname' => $user->firstname,
            'middlename' => $user->middlename,
            'lastname' => $user->lastname,
            'username' => strtolower($user->lastname) . rand(100, 500),
            'email' => strtolower($user->lastname) . '-' . rand(100, 500) . '@gsvnet.nl',
            'password' => str_random(10),
            'type' => User::FORMERMEMBER
        ]);

        $newUser->save();
        $profile = new UserProfile;
        $profile->yearGroup()->associate($this->yearToId[$user->year]);
        $newUser->profile()->save($profile);
        
        return $newUser;
    }

    /**
     * @param User $oldUser
     * @param $newUser
     * @return User
     */
    private function mergeUser(User $oldUser, $newUser)
    {
        if($this->confirm('Naam importeren?', false))
        {
            $oldUser->firstname = $newUser->firstname;
            $oldUser->middlename = $newUser->middlename;
            $oldUser->lastname = $newUser->lastname;
            $oldUser->save();
        }

        if($this->confirm('Jaarverband importeren?', true))
        {
            if (!$oldUser->profile) {
                $profile = new UserProfile;
                $oldUser->profile()->save($profile);
            }

            $oldUser->profile->yearGroup()->associate($this->yearToId[$newUser->year]);
            $oldUser->profile->save();
        }

        return $oldUser;
    }

    private function createUserDataRow($i, User $user)
    {
        $cols = collect([
            $i,
            $user->present()->membershipType,
            $user->present()->fullName
        ]);

        if ($user->profile && $user->profile->yearGroup)
        {
            $cols->push($user->profile->yearGroup->present()->nameWithYear);
        }
        else
        {
            $cols->push("Onbekend");
        }

        return $cols;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $contents = $this->files->get($this->argument('file'));

        $users = json_decode($contents);

        $found = 0; $analyzed = 0;

        $bar = $this->output->createProgressBar(count($users));

        foreach($users as $user)
        {
            $analyzed++;

            $this->info("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");

            $this->info("Uit het Excelbestand:\n");
            $this->outputFromJSON($user);

            $storedUsers = User::where('lastname', $user->lastname)
                ->where(function($query) use ($user) {
                    $query->whereHas('profile.yearGroup', function ($query) use ($user) {
                        $query->whereRaw('ABS(year - ?) < 5', [$user->year]);
                    });

                    $query->orWhereHas('profile', function ($query) {
                        $query->whereNull('year_group_id');
                    });
                })
                ->with('profile.yearGroup')
                ->get();


            if ($storedUsers->count() > 0)
            {
                $found++;

                $tableRows = collect([]);

                foreach ($storedUsers as $i => $storedUser)
                {
                    $tableRows->push($this->createUserDataRow($i + 1, $storedUser));
                }

                $this->info("\nGevonden in de database:\n");
                $this->table(['#', 'Type', 'Naam', 'Jaarverband'], $tableRows);

                $choices = ['x' => 'Overslaan', '+' => 'Nieuw aanmaken'];

                foreach($storedUsers as $i => $storedUser)
                {
                    $choices[$i + 1] = "Samenvoegen met " . $storedUser->present()->fullName;
                }


                $result = $this->choice('Wat te doe je?', $choices, 'x');

                if($result == 'x')
                {
                    $bar->advance();
                    continue;
                }

                $newUser = ($result == '+'
                    ? $this->createNewUser($user)
                    : $this->mergeUser($storedUsers[$result - 1], $user));

                $this->info("\nOpgeslagen als:\n");

                $tableRows = collect([]);
                $tableRows->push($this->createUserDataRow(">", $newUser));
                $this->table(['#', 'Type', 'Naam', 'Jaarverband'], $tableRows);

            }
            else
            {
                $newUser = $this->createNewUser($user);

                $this->info("\nOpgeslagen als:\n");

                $tableRows = collect([]);
                $tableRows->push($this->createUserDataRow(">", $newUser));
                $this->table(['#', 'Type', 'Naam', 'Jaarverband'], $tableRows);
            }

            $this->info("\n\n");
            $bar->advance();
            $this->confirm("\n\nDoorgaan?", true);
        }

        $bar->finish();

        $this->info($found . " of " . $analyzed . " where potentially stored in the database.");
    }
}
