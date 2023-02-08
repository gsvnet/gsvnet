<?php

namespace App\Helpers\Forum\Threads;

use App\Helpers\Core\Validator;
use App\Helpers\Forum\LikeRepository;
use Illuminate\Validation\Factory;

class DislikeThreadValidator extends Validator
{
    public static $rules = [
        'threadId' => 'required|exists:forum_threads,id',
        'userId' => 'required',
    ];

    private $likes;

    private $threads;

    public function __construct(LikeRepository $likes, ThreadRepository $threads, Factory $factory)
    {
        $this->likes = $likes;
        $this->threads = $threads;

        parent::__construct($factory);
    }

    protected function after($data)
    {
        $likes = $this->likes->countByThreadIdAndUserId($data['threadId'], $data['userId']);
        $thread = $this->threads->requireById($data['threadId']);

        if ($likes == 0) {
            $this->addError('userId', 'Bericht nog niet geliket');
        } elseif ($thread->author_id == $data['userId']) {
            $this->addError('userId', 'Niet je eigen posts liken!');
        }
    }
}
