<?php

namespace App\Commands\Members;

use App\Commands\Command;
use App\Helpers\Users\User;
use App\Helpers\Users\ValueObjects\Email;
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
     *
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

    public static function fromRequest(Request $request, User $host, User $guest)
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

    public function getHost(): User
    {
        return $this->host;
    }

    public function getGuest(): User
    {
        return $this->guest;
    }

    public function getEmail(): Email
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
