<?php

use GSVnet\Forum\Replies\ReplyCreatorListener;
use GSVnet\Forum\Replies\ReplyDeleterListener;
use GSVnet\Forum\Replies\ReplyForm;
use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Forum\Replies\ReplyUpdaterListener;
use GSVnet\Forum\Threads\ThreadRepository;
use GSVnet\Tags\TagRepository;

class ForumRepliesController extends BaseController implements ReplyCreatorListener, ReplyUpdaterListener, ReplyDeleterListener {
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

    // bounces the user to the correct page of a thread for the indicated comment
    public function getReplyRedirect($threadSlug, $replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if ( ! $reply->isManageableBy(Auth::user()))
            return redirect('/');

        $generator = App::make('GSVnet\Forum\Replies\ReplyQueryStringGenerator');
        $queryString = $generator->generate($reply, $this->repliesPerPage);

        return redirect(action('ForumThreadsController@getShowThread', [$thread]) . $queryString);
    }

    // reply to a thread
    public function postCreateReply($threadSlug)
    {
        $thread = $this->threads->requireBySlug($threadSlug);

        return App::make('GSVnet\Forum\Replies\ReplyCreator')->create($this, [
            'body'   => Input::get('body'),
            'author' => Auth::user(),
        ], $thread->id, new ReplyForm);
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
