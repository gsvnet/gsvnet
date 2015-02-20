<?php
use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Forum\Threads\ThreadRepository;
use GSVnet\Markdown\HtmlMarkdownConverter;
use GSVnet\Permissions\NoPermissionException;
use GSVnet\Permissions\Permission;

class ForumApiController extends BaseController {

    private $markdown;

    function __construct(HtmlMarkdownConverter $markdown)
    {
        $this->markdown = $markdown;
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

        if ( ! $thread->public && ! Permission::has('threads.show-private'))
            throw new NoPermissionException;

        return response()->json([
            'author' => $reply->author->username,
            'markdown' => $reply->body
        ]);
    }

    public function quoteThread(ThreadRepository $threads, $threadId)
    {
        $thread = $threads->requireById($threadId);

        if ( ! $thread->public && ! Permission::has('threads.show-private'))
            throw new NoPermissionException;

        return response()->json([
            'author' => $thread->author->username,
            'markdown' => $thread->body
        ]);
    }
}