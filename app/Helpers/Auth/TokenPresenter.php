<?php

namespace App\Helpers\Auth;

use Config;
use Laracasts\Presenter\Presenter;

class TokenPresenter extends Presenter
{
    /**
     * TokenPresenter constructor.
     *
     * @param  Token  $entity
     */
    public function __construct(Token $entity)
    {
        parent::__construct($entity);
    }

    public function url()
    {
        return Config::get('gsvnet.malfondsUrl').'/login?token='.$this->entity->token;
    }
}
