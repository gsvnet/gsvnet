<?php namespace GSVnet\Auth;

use GSVnet\Core\BaseRepository;
use GSVnet\Users\User;

class TokenRepository extends BaseRepository
{
    
    function __construct(Token $model)
    {
        $this->model = $model;
    }

    /**
     * @param $token
     * @return Token
     */
    public function getActiveToken($token)
    {
        return $this->model->active()->where('token', $token)->first();
    }

    /**
     * @param int $userId
     * @return Token
     */
    public function getActiveByUserId($userId)
    {
        return $this->model->active()->where('user_id', $userId)->first();
    }

    public function getOrCreateFor(User $user)
    {
        $token = $this->getActiveByUserId($user->id);
        
        if ($token) {
            return $token;
        }
        
        $token = Token::initiateFor($user);
        $this->save($token);
        return $token;
    }
}