<?php namespace GSV\Handlers\Events;

use Carbon\Carbon;
use GSV\Events\Members\MemberFileWasCreated;
use GSV\Events\Members\ProfileEvent;
use GSV\Helpers\Users\ProfileActions\ProfileActionPresenter;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Message;

class AbactisInformer
{
    /**
     * @var Mailer $mailer
     */
    protected $mailer;
    /**
     * @var Repository
     */
    private $config;

    /**
     * AbactisInformer constructor.
     * @param Mailer $mailer
     * @param Repository $config
     */
    public function __construct(Mailer $mailer, Repository $config)
    {
        $this->mailer = $mailer;
        $this->config = $config;
    }

    public function handle(ProfileEvent $event)
    {
        // Don't send an email if someone manages someone else's profile
        if ($event->getManager()->getKey() != $event->getUser()->getKey())
            return;

        $user = $event->getUser();
        $change = ProfileActionPresenter::$map[get_class($event)];

        $subject = "Wijziging " . strtolower($change) . " van " . $user->present()->fullName;
        $to = $this->config->get('gsvnet.email.profile');

        $this->mailer->send('emails.users.profile-update', compact('user'), function (Message $message) use ($to, $subject) {
            $message->to($to, 'Abactis der GSV');
            $message->subject($subject);
        });
    }

    public function sendMemberFile(MemberFileWasCreated $event)
    {
        $months = [
            '', 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli',
            'augustus', 'september', 'oktober', 'november', 'december'
        ];
        $month = $months[$event->getAt()->month];
        $year = $event->getAt()->year;
        $filePath = $event->getFilePath();
        $to = $this->config->get('gsvnet.email.senate');
        $subject = "Ledenbestand " . $month . " " . $year;
        $this->mailer->send('emails.admin.memberfile', compact(['month', 'year']), function ($m) use ($to, $subject, $filePath) {
            $m->to($to, 'Abactis der GSV');
            $m->subject($subject);
            $m->attach($filePath, ['mime' => 'application/vnd.ms-excel']);
        });
    }
}