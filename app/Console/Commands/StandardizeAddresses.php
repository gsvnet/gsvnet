<?php

namespace App\Console\Commands;

use App\Commands\Members\ChangeAddress;
use App\Helpers\Core\DispatchesJobs;
use App\Helpers\Newsletters\NewsletterList;
use App\Helpers\Users\User;
use App\Helpers\Users\UsersRepository;
use App\Helpers\Users\UserTransformer;
use App\Helpers\Users\ValueObjects\Address;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class StandardizeAddresses extends Command
{
    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'members:standardize-addresses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Standardize addresses.';

    /**
     * @var NewsletterList
     */
    protected $newsletterList;

    /**
     * @var UserTransformer
     */
    protected $userTransformer;

    /**
     * @var UsersRepository
     */
    private $users;

    /**
     * @var array
     */
    private $values = [
        'leden' => User::MEMBER,
        'reünisten' => User::REUNIST,
    ];

    /**
     * BulkNewsletterSubscriptions constructor.
     *
     * @param  UsersRepository  $users
     */
    public function __construct(UsersRepository $users)
    {
        parent::__construct();
        $this->users = $users;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $for = $this->argument('of');

        if (! array_key_exists($for, $this->values)) {
            $this->error('Kies uit leden of reünisten');

            return;
        }

        $type = $this->values[$for];

        // Find users and sort by zip code.
        $users = $this->users->getAllVerifiedByType($type)->sortBy(function (User $user) {
            return $user->profile->zip_code;
        });

        $users->each([$this, 'standardizeAddress']);
    }

    public function standardizeAddress(User $user)
    {
        if (! $user->profile) {
            return;
        }

        try {
            $old = new Address(
                $user->profile->address,
                $user->profile->zip_code,
                $user->profile->town,
                $user->profile->country
            );

            $new = new Address(
                preg_replace('/\s+/', ' ', ucwords(mb_strtolower(trim($user->profile->address)))),
                preg_replace('/^(\d{4})\s*([A-Z]{2})$/', '$1$2', trim(mb_strtoupper($user->profile->zip_code))),
                preg_replace('/\s+/', ' ', ucwords(mb_strtolower(trim($user->profile->town)))),
                preg_replace('/\s+/', ' ', ucwords(mb_strtolower(trim($user->profile->country)))) ?: 'Nederland'
            );

            if ($old->equals($new)) {
                return;
            }

            // Show a confirm message with changes being made.
            $confirmed = $this->confirm(
                "{$user->present()->fullName}: ".
                "'{$old->getStreet()}' -> '{$new->getStreet()}', ".
                "'{$old->getZipCode()}' -> '{$new->getZipCode()}', ".
                "'{$old->getTown()}' -> '{$new->getTown()}', ".
                "'{$old->getCountry()}' -> '{$new->getCountry()}'?",
                true
            );

            if ($confirmed) {
                $this->dispatch(new ChangeAddress($user, $user, $new));
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['of', InputArgument::REQUIRED, 'leden of reünisten'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
