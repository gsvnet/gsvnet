<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\BaseController;
use App\Commands\Forum\DislikeReplyCommand;
use App\Commands\Forum\DislikeThreadCommand;
use App\Commands\Forum\LikeReplyCommand;
use App\Commands\Forum\LikeThreadCommand;
use App\Helpers\Core\Exceptions\ValidationException;
use App\Helpers\Forum\Replies\DislikeReplyValidator;
use App\Helpers\Forum\Replies\LikeReplyValidator;
use App\Helpers\Forum\Replies\ReplyRepository;
use App\Helpers\Forum\Threads\DislikeThreadValidator;
use App\Helpers\Forum\Threads\LikeThreadValidator;
use App\Helpers\Forum\Threads\ThreadRepository;
use App\Helpers\Markdown\HtmlMarkdownConverter;
use App\Helpers\Permissions\NoPermissionException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;

class ForumApiController extends BaseController
{
    private $markdown;

    public function __construct(HtmlMarkdownConverter $markdown)
    {
        $this->markdown = $markdown;
        parent::__construct();
    }

    public function preview()
    {
        $data = Request::get('text');

        return $this->markdown->convertMarkdownToHtml($data);
    }

    public function quoteReply(ReplyRepository $replies, $replyId): Response
    {
        $reply = $replies->requireById($replyId);
        $thread = $reply->thread;

        if (! $thread->public && Gate::denies('threads.show-internal')) {
            throw new NoPermissionException;
        }

        if ($thread->private && Gate::denies('threads.show-private')) {
            throw new NoPermissionException;
        }

        return response()->json([
            'author' => $reply->author->username,
            'markdown' => $reply->body,
        ]);
    }

    public function quoteThread(ThreadRepository $threads, $threadId): Response
    {
        $thread = $threads->requireById($threadId);

        if (! $thread->public && Gate::denies('threads.show-internal')) {
            throw new NoPermissionException;
        }

        if ($thread->private && Gate::denies('threads.show-private')) {
            throw new NoPermissionException;
        }

        return response()->json([
            'author' => $thread->author->username,
            'markdown' => $thread->body,
        ]);
    }

    public function likeReply(LikeReplyValidator $validator, $replyId): Response
    {
        $data = [
            'userId' => Auth::user()->id,
            'replyId' => $replyId,
        ];

        try {
            $validator->validate($data);
        } catch (ValidationException $e) {
            return response()->json($e->getErrors(), 400);
        }

        $this->dispatchFromArray(LikeReplyCommand::class, $data);

        return response()->json();
    }

    public function dislikeReply(DislikeReplyValidator $validator, $replyId): Response
    {
        $data = [
            'userId' => Auth::user()->id,
            'replyId' => $replyId,
        ];

        try {
            $validator->validate($data);
        } catch (ValidationException $e) {
            return response()->json($e->getErrors(), 400);
        }

        $this->dispatchFromArray(DislikeReplyCommand::class, $data);

        return response()->json();
    }

    public function likeThread(LikeThreadValidator $validator, $threadId): Response
    {
        $data = [
            'userId' => Auth::user()->id,
            'threadId' => $threadId,
        ];

        try {
            $validator->validate($data);
        } catch (ValidationException $e) {
            return response()->json($e->getErrors(), 400);
        }

        $this->dispatchFromArray(LikeThreadCommand::class, $data);

        return response()->json();
    }

    public function dislikeThread(DislikeThreadValidator $validator, $threadId): Response
    {
        $data = [
            'userId' => Auth::user()->id,
            'threadId' => $threadId,
        ];

        try {
            $validator->validate($data);
        } catch (ValidationException $e) {
            return response()->json($e->getErrors(), 400);
        }

        $this->dispatchFromArray(DislikeThreadCommand::class, $data);

        return response()->json();
    }
}
