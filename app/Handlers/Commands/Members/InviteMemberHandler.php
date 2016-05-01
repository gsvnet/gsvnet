<?php namespace GSV\Handlers\Commands\Members;

use Carbon\Carbon;
use GSV\Commands\Members\InviteMember;
use GSVnet\Auth\Invite;
use GSVnet\Auth\TokenRepository;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;

class InviteMemberHandler
{
    /**
     * @var Mailer
     */
    protected $mailer;

    /**
     * @var TokenRepository
     */
    protected $tokens;

    /**
     * InviteMemberHandler constructor.
     * @param Mailer $mailer
     * @param TokenRepository $tokens
     */
    public function __construct(Mailer $mailer, TokenRepository $tokens)
    {
        $this->mailer = $mailer;
        $this->tokens = $tokens;
    }

    public function handle(InviteMember $command)
    {
        $token = $this->tokens->getOrCreateFor($command->getGuest());

        $data = [
            'url' => $token->present()->url(),
            'personalMessage' => $command->getMessage(),
            'hostName' => $command->getHost()->present()->fullName(),
            'guestTitle' => $command->getTitle(), 
            'guestName' => $command->getName(),
        ];

        // Simply save an invite here, since it is only temporary
        Invite::create([
            'host_id' => $command->getHost()->id,
            'guest_id' => $command->getGuest()->id,
            'name' => $command->getName(),
            'email' => $command->getEmail()->getEmail(),
            'message' => $command->getMessage(),
            'invited_at' => Carbon::now(),
        ]);

        // Mail the guest
        $this->mailer->send('malfonds.mail.invite', $data, function (Message $message) use ($command) {
            $hostName = $command->getHost()->present()->fullName();
            $message->to($command->getEmail()->getEmail(), $command->getName());
            $message->from($command->getHost()->email, $hostName);
            $message->subject("Uitnodiging van {$hostName}");
        });
    }
}