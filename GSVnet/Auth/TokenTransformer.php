<?php namespace GSVnet\Auth;

use GSVnet\BaseTransformer;

class TokenTransformer extends BaseTransformer
{
    public function transform(Token $token)
    {
        return [
            'token' => $token->token,
            'url' => $token->present()->url(),
            'expires_on' => $token->expires_on->toIso8601String(),
            'user_id' => $token->user_id
        ];
    }
}