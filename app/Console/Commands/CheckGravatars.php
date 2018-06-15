<?php

namespace GSV\Console\Commands;

use Illuminate\Console\Command;
use GSVnet\Users\User;
use GSVnet\Users\UsersRepository;
use haampie\Gravatar\Gravatar;

class CheckGravatars extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'gravatar:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for all users whether they have a Gravatar set. Then either remove or add a default avatar.';


    public function __construct(UsersRepository $users)
    {
        parent::__construct();
        $this->users = $users;
    }

    public function handle()
    {
        $menCounter = rand(0, 99);
        $womenCounter = rand(100, 199);

        $users = $this->users->getAllByTypes([User::MEMBER, User::INTERNAL_COMMITTEE]);

        $bar = $this->output->createProgressBar(count($users));

        foreach ($users as $user) {
            $gender = empty($user->profile) ? rand(0,1) : $user->profile->gender;

            $url = Gravatar::image($user->email, 120, 'mm', null, null, true);
            // If Gravatar image is the standard image and no default has been set already.
            if (md5(file_get_contents($url)) == 'bb7cdd7a7ae85633dad820f21a2115cb') {
                if( $user->avatar === -1) {
                    if ($gender == 1)
                        $user->avatar = $menCounter++;
                    else
                        $user->avatar = $womenCounter++;
                }
            } else {
                $user->avatar = -1;
            }

            $user->save();

            $menCounter = $menCounter % 100;
            $womenCounter = max($womenCounter % 200, 100);

            $bar->advance();
        }

        $bar->finish();
    }
}