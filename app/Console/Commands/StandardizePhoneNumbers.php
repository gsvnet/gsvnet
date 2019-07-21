<?php namespace GSV\Console\Commands;

use GSV\Commands\Members\ChangePhone;
use GSVnet\Core\DispatchesJobs;
use GSVnet\Newsletters\NewsletterList;
use GSVnet\Users\User;
use GSVnet\Users\UsersRepository;
use GSVnet\Users\UserTransformer;
use GSVnet\Users\ValueObjects\PhoneNumber;
use Illuminate\Console\Command;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use Symfony\Component\Console\Input\InputArgument;

class StandardizePhoneNumbers extends Command
{
    use DispatchesJobs;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'members:standardize-phone-numbers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Standardize phone numbers.';

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
        'reünisten' => User::REUNIST
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
            $this->error('Kies uit leden of reünisten');
            return;
        }

        $type = $this->values[$for];
        $users = $this->users->getAllVerifiedByType($type);

        $users->each([$this, 'standardizePhoneNumber']);
    }

    public function standardizePhoneNumber(User $user)
    {
        $parser = PhoneNumberUtil::getInstance();

        if (!$user->profile) {
            return true;
        }

        $phone = $user->profile->phone;

        try {
            $phoneNumber = $parser->parse($phone, "NL");
            $formatted = $parser->format($phoneNumber, PhoneNumberFormat::E164);

            // Ask to save if not the same
            if ($phone !== $formatted && $this->confirm("Telefoonnummer '{$phone}' van {$user->present()->fullName} opslaan als '{$formatted}'?", true)) {
                $this->dispatch(new ChangePhone($user, $user, new PhoneNumber($formatted)));
            }
        } catch (NumberParseException $e) {
            $this->error($e->getMessage());
        }

        return true;
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
