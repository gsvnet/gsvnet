<?php

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Commands\Forum\DeleteReplyCommand;
use App\Commands\Forum\EditReplyCommand;
use App\Commands\Forum\ReplyToThreadCommand;
use App\Helpers\Events\EventsRepository;
use App\Helpers\Forum\Replies\ReplyRepository;
use App\Http\Validators\DeleteReplyValidator;
use App\Http\Validators\EditReplyValidator;
use App\Http\Validators\ReplyToThreadValidator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

class ForumRepliesController extends BaseController
{
    protected $repliesPerPage = 20;

    protected $replies;

    public function __construct(ReplyRepository $replies, EventsRepository $events)
    {
        parent::__construct();

        $this->replies = $replies;

        View::share('events', $events->upcoming(5));
    }

    public function postCreateReply(ReplyToThreadValidator $validator, $threadSlug): RedirectResponse
    {
        $data = [
            'threadSlug' => $threadSlug,
            'authorId' => Auth::user()->id,
            'reply' => Request::get('body'),
        ];

        $validator->validate($data);

        $this->dispatchFromArray(ReplyToThreadCommand::class, $data);

        return redirect()->back();
    }

    public function getEditReply($replyId): View
    {
        $reply = $this->replies->getById($replyId);
        $author = $reply->author;
        $this->authorize('reply.manage', $reply);

        return view('forum.replies.edit', compact('reply', 'author'));
    }

    public function postEditReply(EditReplyValidator $validator, $replyId)
    {
        $reply = $this->replies->requireById($replyId);

        $this->authorize('reply.manage', $reply);

        $data = [
            'replyId' => $replyId,
            'reply' => Request::get('body'),
        ];

        $validator->validate($data);

        $this->dispatchFromArray(EditReplyCommand::class, $data);

        return $this->redirectToReply($replyId);
    }

    public function getDelete($replyId): View
    {
        $reply = $this->replies->requireById($replyId);

        $this->authorize('reply.manage', $reply);

        return view('forum.replies.delete', compact('reply'));
    }

    public function postDelete(DeleteReplyValidator $validator, $replyId): RedirectResponse
    {
        $reply = $this->replies->requireById($replyId);

        $this->authorize('reply.manage', $reply);

        $data = compact('replyId');

        $validator->validate($data);

        $this->dispatchFromArray(DeleteReplyCommand::class, $data);

        return redirect('/forum');
    }

    public function redirectToReply($replyId): RedirectResponse
    {
        $reply = $this->replies->requireById($replyId);

        return redirect()->action([\App\Http\Controllers\ForumThreadsController::class, 'getShowThread'], [$reply->thread->slug,
            'page='.$reply->thread->getReplyPageNumber($replyId, $this->repliesPerPage).
            '#reactie-'.$reply->id, ]
        );
    }
}
