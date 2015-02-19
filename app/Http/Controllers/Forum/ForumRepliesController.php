<?php

use GSV\Commands\DeleteReplyCommand;
use GSV\Commands\EditReplyCommand;
use GSV\Commands\ReplyToThreadCommand;
use GSVnet\Forum\Replies\ReplyForm;
use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Forum\Threads\ThreadRepository;
use GSVnet\Tags\TagRepository;
use Illuminate\Support\Collection;

class ForumRepliesController extends BaseController {
    protected $tags;
    protected $sections;

    protected $repliesPerPage = 20;

    public function __construct(ThreadRepository $threads, ReplyRepository $replies, TagRepository $tags)
    {
        parent::__construct();
        
        $this->threads = $threads;
        $this->replies = $replies;
        $this->tags = $tags;
    }

    public function postCreateReply($threadSlug)
    {
        $data = new Collection([
            'threadSlug' => $threadSlug,
            'authorId' => Auth::user()->id,
            'reply' => Input::get('body')
        ]);

        $this->dispatchFrom(ReplyToThreadCommand::class, $data);

        return redirect()->action('ForumThreadsController@getShowThread', [$threadSlug]);
    }

    public function getEditReply($replyId)
    {
        $reply = $this->replies->getById($replyId);

        return view('forum.replies.edit', compact('reply'));
    }

    public function postEditReply($replyId)
    {
        $data = [
            'replyId' => $replyId,
            'reply' => Input::get('body')
        ];

        $this->dispatchFrom(EditReplyCommand::class, new Collection($data));

        return redirect('/forum');
    }

    public function getDelete($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        return view('forum.replies.delete', compact('reply'));
    }

    public function postDelete($replyId)
    {
        $this->dispatchFrom(DeleteReplyCommand::class, new Collection(compact('replyId')));

        return redirect('/forum');
    }
}
