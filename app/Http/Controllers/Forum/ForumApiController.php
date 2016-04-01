<?php
use GSV\Commands\Forum\DislikeReplyCommand;
use GSV\Commands\Forum\DislikeThreadCommand;
use GSV\Commands\Forum\LikeReplyCommand;
use GSV\Commands\Forum\LikeThreadCommand;
use GSVnet\Core\Exceptions\ValidationException;
use GSVnet\Forum\Replies\DislikeReplyValidator;
use GSVnet\Forum\Replies\LikeReplyValidator;
use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Forum\Threads\DislikeThreadValidator;
use GSVnet\Forum\Threads\LikeThreadValidator;
use GSVnet\Forum\Threads\ThreadRepository;
use GSVnet\Markdown\HtmlMarkdownConverter;
use GSVnet\Permissions\NoPermissionException;
use Illuminate\Support\Collection;

class ForumApiController extends BaseController {

    private $markdown;

    function __construct(HtmlMarkdownConverter $markdown)
    {
        $this->markdown = $markdown;
        parent::__construct();
    }

    public function preview()
    {
        $data = Input::get('text');
        return $this->markdown->convertMarkdownToHtml($data);
    }

    public function quoteReply(ReplyRepository $replies, $replyId)
    {
        $reply = $replies->requireById($replyId);
        $thread = $reply->thread;

        if ( ! $thread->public && Gate::denies('threads.show-private'))
            throw new NoPermissionException;

        return response()->json([
            'author' => $reply->author->username,
            'markdown' => $reply->body
        ]);
    }

    public function quoteThread(ThreadRepository $threads, $threadId)
    {
        $thread = $threads->requireById($threadId);

        if ( ! $thread->public && Gate::denies('threads.show-private'))
            throw new NoPermissionException;

        return response()->json([
            'author' => $thread->author->username,
            'markdown' => $thread->body
        ]);
    }

    public function likeReply(LikeReplyValidator $validator, $replyId)
    {
        $data = [
            'userId' => Auth::user()->id,
            'replyId' => $replyId
        ];

        try {
            $validator->validate($data);
        } catch(ValidationException $e) {
            return response()->json($e->getErrors(), 400);
        }

        $this->dispatchFromArray(LikeReplyCommand::class, $data);

        return response()->json();
    }

    public function dislikeReply(DislikeReplyValidator $validator, $replyId)
    {
        $data = [
            'userId' => Auth::user()->id,
            'replyId' => $replyId
        ];

        try {
            $validator->validate($data);
        } catch(ValidationException $e) {
            return response()->json($e->getErrors(), 400);
        }

        $this->dispatchFromArray(DislikeReplyCommand::class, $data);

        return response()->json();
    }

    public function likeThread(LikeThreadValidator $validator, $threadId)
    {
        $data = [
            'userId' => Auth::user()->id,
            'threadId' => $threadId
        ];

        try {
            $validator->validate($data);
        } catch(ValidationException $e) {
            return response()->json($e->getErrors(), 400);
        }

        $this->dispatchFromArray(LikeThreadCommand::class, $data);

        return response()->json();
    }

    public function dislikeThread(DislikeThreadValidator $validator, $threadId)
    {
        $data = [
            'userId' => Auth::user()->id,
            'threadId' => $threadId
        ];

        try {
            $validator->validate($data);
        } catch(ValidationException $e) {
            return response()->json($e->getErrors(), 400);
        }

        $this->dispatchFromArray(DislikeThreadCommand::class, $data);

        return response()->json();
    }
}