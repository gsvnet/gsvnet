<?php namespace GSV\Helpers\Forum\Replies;

use GSV\Helpers\Core\Validator;
use GSV\Helpers\Forum\LikeRepository;
use Illuminate\Validation\Factory;

class LikeReplyValidator extends Validator {

    static $rules = [
        'replyId' => 'required|exists:forum_replies,id',
        'userId' => 'required'
    ];

    private $likes;
    private $replies;

    function __construct(LikeRepository $likes, ReplyRepository $replies, Factory $factory)
    {
        $this->likes = $likes;
        $this->replies = $replies;

        parent::__construct($factory);
    }

    protected function after($data)
    {
        $likes = $this->likes->countByReplyIdAndUserId($data['replyId'], $data['userId']);
        $reply = $this->replies->requireById($data['replyId']);

        if($likes != 0)
        {
            $this->addError('userId', 'Al geliket');
        }

        if($reply->author_id == $data['userId'])
        {
            $this->addError('userId', 'Niet je eigen posts liken!');
        }
    }
}