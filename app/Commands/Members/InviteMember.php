<?php namespace GSV\Commands\Members;

use GSV\Commands\Command;
use GSV\Helpers\Users\User;
use GSV\Helpers\Users\ValueObjects\Email;
use Illuminate\Http\Request;

class InviteMember extends Command
{
    /**
     * @var User
     */
    protected $host;

    /**
     * @var User
     */
    protected $guest;

    /**
     * @var Email
     */
    protected $email;

    protected $message;
    protected $name;
    protected $title;

    /**
     * InviteMember constructor.
     * @param User $host
     * @param User $guest
     * @param Email $email
     * @param $title
     * @param $name
     * @param $message
     */
    public function __construct(User $host, User $guest, Email $email, $title, $name, $message)
    {
        $this->host = $host;
        $this->guest = $guest;
        $this->email = $email;
        $this->message = $message;
        $this->name = $name;
        $this->title = $title;
    }

    static function fromRequest(Request $request, User $host, User $guest)
    {
        $email = new Email($request->get('email'));
        return new self(
            $host,
            $guest,
            $email,
            $request->get('title', 'amice/amica'),
            $request->get('name'),
            $request->get('message')
        );
    }

    /**
     * @return User
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return User
     */
    public function getGuest()
    {
        return $this->guest;
    }

    /**
     * @return Email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
}