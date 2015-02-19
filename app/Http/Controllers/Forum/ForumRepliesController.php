<?php

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

        $this->prepareViewData();
    }

    public function postCreateReply($threadSlug)
    {
        $data = new Collection([
            'threadSlug' => $threadSlug,
            'authorId' => Auth::user()->id,
            'reply' => Input::get('body')
        ]);

        $this->dispatchFrom(ReplyToThreadCommand::class, $data);

        return redirect('/forum');
    }

    public function replyCreationError($errors)
    {
        return redirect()->back()->withErrors($errors);
    }

    public function replyCreated($reply)
    {
        return redirect($reply->present()->url);
    }

    public function getEditReply($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if ( ! $reply->isManageableBy(Auth::user()))
            return redirect('/');

        return view('forum.replies.edit', compact('reply'));
    }

    public function postEditReply($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if ( ! $reply->isManageableBy(Auth::user()))
            return redirect('/');

        return App::make('GSVnet\Forum\Replies\ReplyUpdater')->update($reply, $this, [
            'body' => Input::get('body'),
        ], new ReplyForm);
    }

    public function replyUpdateError($errors)
    {
        return redirect()->back()->withErrors($errors);
    }

    public function replyUpdated($reply)
    {
        return redirect($reply->present()->url);
    }

    public function getDelete($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if ( ! $reply->isManageableBy(Auth::user()))
            return Redirect::to('/');

        return view('forum.replies.delete', compact('reply'));
    }

    public function postDelete($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if ( ! $reply->isManageableBy(Auth::user()))
            return redirect('/');

        return App::make('GSVnet\Forum\Replies\ReplyDeleter')->delete($this, $reply);
    }

    public function replyDeleted($thread)
    {
        return redirect()->action('ForumThreadsController@getShowThread', [$thread->slug]);
    }

    private function prepareViewData()
    {
        $forumSections = Config::get('forum.sections');
        View::share(compact('forumSections'));
    }
}
