<?php

namespace App\Console\Commands;

use App\Commands\Members\ChangeMembershipStatus;
use App\Helpers\Core\DispatchesJobs;
use App\Helpers\Users\User;
use Illuminate\Console\Command;

class MigrateFormerMembers extends Command
{
    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'formermembers:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate former members to the new system.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*if (!$this->confirm('Hiermee worden alle oud-leden volgens het nieuwe systeem in de database gezet. Wil je doorgaan?')) {
            return;
        }*/
        $action = $this->choice('Wil je de migratie daadwerkelijk uitvoeren, of het overzicht controleren?', ['Uitvoeren', 'Controleren', 'Annuleren'], 2);
        if ($action == 'Annuleren') {
            return;
        }

        // Such quality code
        $this->info('ChangeMembershipStatus heeft de authorisatie van een webcielid nodig.');
        $adminName = $this->ask('Noem de username van een webcielid om deze als admin user te gebruiken.');
        $adminUser = User::where('username', $adminName)->first();
        $reunistCount = 0;
        $exmemberCount = 0;

        User::with('profile')->where('type', User::REUNIST)->get()->each(function ($user) use (&$exmemberCount, &$reunistCount, $action, $adminUser) {
            $log = $user->firstname.' '.$user->lastname.' >>> ';
            if (! $user->profile || ! $user->profile->reunist) {
                $exmemberCount++;
                if ($action == 'Uitvoeren') {
                    $this->dispatch(new ChangeMembershipStatus(User::EXMEMBER, $user, $adminUser));
                }
                $log .= 'Ex-lid';
            } else {
                $reunistCount++;
                if ($action == 'Uitvoeren') {
                    $this->dispatch(new ChangeMembershipStatus(User::REUNIST, $user, $adminUser));
                }
                $log .= 'Reünist';
            }
            $this->line($log);
        });
        $this->line($reunistCount.' reunisten, '.$exmemberCount.' ex-leden');
        ($action == 'Uitvoeren') ? $this->info('Migratie voltooid!') : $this->info('Overzicht gereed.');
    }
}
