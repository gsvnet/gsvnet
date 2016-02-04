<?php

use GSV\Commands\Forum\DeleteReplyCommand;
use GSV\Commands\Forum\EditReplyCommand;
use GSV\Commands\Forum\ReplyToThreadCommand;
use GSV\Http\Requests\DeleteReplyValidator;
use GSV\Http\Requests\EditReplyValidator;
use GSV\Http\Requests\ReplyToThreadValidator;
use GSVnet\Events\EventsRepository;
use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Permissions\NoPermissionException;
use GSVnet\Permissions\Permission;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class ForumRepliesController extends BaseController {

    protected $repliesPerPage = 20;

    public function __construct(ReplyRepository $replies, EventsRepository $events)
    {
        parent::__construct();
        
        $this->replies = $replies;

        $events = $events->upcoming(5);

        View::share('events', $events);
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

        return redirect()->back();
    }

    public function getEditReply($replyId)
    {
        $reply = $this->replies->getById($replyId);

        if(! Permission::has('threads.manage') && $reply->author_id != Auth::user()->id)
            throw new NoPermissionException;

        return view('forum.replies.edit', compact('reply'));
    }

    public function postEditReply(EditReplyValidator $validator, $replyId)
    {
        $reply = $this->replies->requireById($replyId);

        $data = [
            'replyId' => $replyId,
            'reply' => Input::get('body')
        ];

        if(! Permission::has('threads.manage') && $reply->author_id != Auth::user()->id)
            throw new NoPermissionException;

        $validator->validate($data);

        $this->dispatchFrom(EditReplyCommand::class, new Collection($data));

        return $this->showReply($replyId);
    }

    public function getDelete($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if(! Permission::has('threads.manage') && $reply->author_id != Auth::user()->id)
            throw new NoPermissionException;

        return view('forum.replies.delete', compact('reply'));
    }

    public function postDelete(DeleteReplyValidator $validator, $replyId)
    {
        $reply = $this->replies->requireById($replyId);

        $data = compact('replyId');

        if(! Permission::has('threads.manage') && $reply->author_id != Auth::user()->id)
            throw new NoPermissionException;

        $validator->validate($data);

        $this->dispatchFrom(DeleteReplyCommand::class, new Collection($data));

        return redirect('/forum');
    }

    public function showReply($replyId)
    {
        $reply = $this->replies->requireById($replyId);
        return redirect()->action('ForumThreadsController@getShowThread', [$reply->thread->slug,
            "page=" . $reply->thread->getReplyPageNumber($replyId, $this->repliesPerPage) .
            "#reactie-" . $reply->id]
        );
    }
}
