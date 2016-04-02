<?php namespace GSV\Handlers\Events;

use GSV\Events\Members\ProfileEvent;
use GSVnet\Users\ProfileActions\ProfileActionPresenter;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Message;

class AbactisInformer implements ShouldQueue
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
}