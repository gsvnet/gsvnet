<?php namespace GSV\Console\Commands;

use GSV\Commands\Members\ChangeAddress;
use GSVnet\Core\DispatchesJobs;
use GSVnet\Newsletters\NewsletterList;
use GSVnet\Users\User;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserTransformer;
use GSVnet\Users\ValueObjects\Address;
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
        'oud-leden' => User::FORMERMEMBER
    ];

    /**
     * BulkNewsletterSubscriptions constructor.
     * @param UsersRepository $users
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

        if (!array_key_exists($for, $this->values)) {
            $this->error('Kies uit leden of oud-leden');
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
        if (!$user->profile) {
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
                trim($user->profile->address),
                preg_replace('/^(\d{4})\s*([A-Z]{2})$/', '$1$2', trim(mb_strtoupper($user->profile->zip_code))),
                trim($user->profile->town),
                trim($user->profile->country)
            );

            if ($old->equals($new)) {
                return;
            }

            // Show a confirm message with changes being made.
            $confirmed = $this->confirm(
                "{$user->present()->fullName}: " .
                "'{$old->getStreet()}' -> '{$new->getStreet()}', " .
                "'{$old->getZipCode()}' -> '{$new->getZipCode()}', " .
                "'{$old->getTown()}' -> '{$new->getTown()}', " .
                "'{$old->getCountry()}' -> '{$new->getCountry()}'?",
                true
            );

            if ($confirmed) {
                $this->dispatch(new ChangeAddress($user, $user, $new));
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

        return;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['of', InputArgument::REQUIRED, 'leden of oud-leden'],
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
