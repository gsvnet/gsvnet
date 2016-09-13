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
        $users = $this->users->getAllVerifiedByType($type);

        $users->each([$this, 'standardizeAddress']);
    }

    public function standardizeAddress(User $user)
    {
        if (!$user->profile) {
            return;
        }

        try {
            if ($oldZip = $user->profile->zip_code === null) {
                return;
            }

            $newZip = preg_replace('/^(\d{4})\s*([A-Z]{2})$/', '$1$2', trim(mb_strtoupper($oldZip)));

            // Ask to save if not the same
            if ($newZip !== $user->profile->zip_code && $this->confirm("Postcode '{$oldZip}' van {$user->present()->fullName} opslaan als '{$newZip}'?",
                    true)
            ) {
                $this->dispatch(new ChangeAddress($user, $user, new Address(
                    $user->profile->address,
                    $newZip,
                    $user->profile->town,
                    $user->profile->country
                )));
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
