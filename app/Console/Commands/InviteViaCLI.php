<?php

namespace GSV\Console\Commands;

use GSV\Commands\Members\InviteMember;
use GSV\Helpers\Core\DispatchesJobs;
use GSV\Helpers\Users\User;
use GSV\Helpers\Users\UsersRepository;
use GSV\Helpers\Users\ValueObjects\Email;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;

class InviteViaCLI extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invite:json {file} {hostId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invite a list of former members';

    /**
     * @var Filesystem
     */
    private $files;

    /**
     * @var UsersRepository
     */
    private $users;

    /**
     * @var User
     */
    private $host;

    /**
     * Create a new command instance.
     * @param Filesystem $files
     * @param UsersRepository $users
     */
    public function __construct(Filesystem $files, UsersRepository $users)
    {
        parent::__construct();
        $this->files = $files;
        $this->users = $users;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = $this->files->get($this->argument('file'));
        $this->host = $this->users->memberOrFormerByIdWithProfile($this->argument('hostId'));
        
        $list = json_decode($file);

        array_map([$this, 'invite'], $list);
    }

    /**
     * @param \stdClass $data
     */
    public function invite($data)
    {
        $member = $this->users->memberOrFormerByIdWithProfile($data->id);
        $email = new Email($data->email);
        $message = $this->generateMessage($data->name);
        $invite = new InviteMember($this->host, $member, $email, $data->title, $data->name, $message);
        $this->dispatch($invite);
    }

    public function generateMessage($name)
    {
        return <<<MESSAGE
Beste {$name},

In het huidige oud-ledenbestand van de GSV vonden we uw e-mailadres. Zou u uw gegevens willen controleren via de link hierboven?

Gemiddeld kost het bijwerken van uw gegevens minder tijd dan het lezen van deze mail.

Bedankt!
MESSAGE;
    }
}
