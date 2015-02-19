<?php

use GSV\Commands\DeleteReplyCommand;
use GSV\Commands\EditReplyCommand;
use GSV\Commands\ReplyToThreadCommand;
use GSV\Http\Requests\DeleteReplyValidator;
use GSV\Http\Requests\EditReplyValidator;
use GSV\Http\Requests\ReplyToThreadRequest;
use GSV\Http\Requests\ReplyToThreadValidator;
use GSVnet\Forum\Replies\ReplyRepository;
use Illuminate\Support\Collection;

class ForumRepliesController extends BaseController {

    protected $repliesPerPage = 20;

    public function __construct(ReplyRepository $replies)
    {
        parent::__construct();
        
        $this->replies = $replies;
    }

    public function postCreateReply(ReplyToThreadValidator $validator, $threadSlug)
    {
        $data = [
            'threadSlug' => $threadSlug,
            'authorId' => Auth::user()->id,
            'reply' => Input::get('body')
        ];

        $validator->validate($data);

        $this->dispatchFrom(ReplyToThreadCommand::class, new Collection($data));

        return redirect()->action('ForumThreadsController@getShowThread', [$threadSlug]);
    }

    public function getEditReply($replyId)
    {
        $reply = $this->replies->getById($replyId);

        return view('forum.replies.edit', compact('reply'));
    }

    public function postEditReply(EditReplyValidator $validator, $replyId)
    {
        $data = [
            'replyId' => $replyId,
            'reply' => Input::get('body')
        ];

        $validator->validate($data);

        $this->dispatchFrom(EditReplyCommand::class, new Collection($data));

        return redirect('/forum');
    }

    public function getDelete($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        return view('forum.replies.delete', compact('reply'));
    }

    public function postDelete(DeleteReplyValidator $validator, $replyId)
    {
        $data = compact('replyId');

        $validator->validate($data);

        $this->dispatchFrom(DeleteReplyCommand::class, new Collection($data));

        return redirect('/forum');
    }
}
