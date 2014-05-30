<?php

use GSVnet\Forum\Replies\ReplyForm;
use GSVnet\Forum\Replies\ReplyPresenter;

class ForumRepliesController extends BaseController implements
    \GSVnet\Forum\Replies\ReplyCreatorListener,
    \GSVnet\Forum\Replies\ReplyUpdaterListener,
    \GSVnet\Forum\Replies\ReplyDeleterListener
{
    protected $tags;
    protected $sections;

    protected $repliesPerPage = 20;

    public function __construct(
        \GSVnet\Forum\Threads\ThreadRepository $threads,
        \GSVnet\Forum\Replies\ReplyRepository $replies,
        \GSVnet\Tags\TagRepository $tags
    ) {
        parent::__construct();
        
        $this->threads  = $threads;
        $this->replies  = $replies;
        $this->tags     = $tags;

        $this->prepareViewData();
    }

    // bounces the user to the correct page of a thread for the indicated comment
    public function getReplyRedirect($threadSlug, $replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if ( ! $reply->isManageableBy(Auth::user())) {
            return Redirect::to('/');
        }

        $generator = App::make('GSVnet\Forum\Replies\ReplyQueryStringGenerator');
        $queryString = $generator->generate($reply, $this->repliesPerPage);

        return Redirect::to(action('ForumThreadsController@getShowThread', [$thread]) . $queryString);
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
        return $this->redirectBack(['errors' => $errors]);
    }

    public function replyCreated($reply)
    {
        $replyPresenter = new ReplyPresenter($reply);
        return $this->redirectTo($replyPresenter->url);
    }

    // edit a reply
    public function getEditReply($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if ( ! $reply->isManageableBy(Auth::user())) {
            return Redirect::to('/');
        }

        $this->title = "Reactie bewerken";
        $this->view('forum.replies.edit', compact('reply'));
    }

    public function postEditReply($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if ( ! $reply->isManageableBy(Auth::user())) {
            return Redirect::to('/');
        }

        return App::make('GSVnet\Forum\Replies\ReplyUpdater')->update($reply, $this, [
            'body' => Input::get('body'),
        ], new ReplyForm);
    }

    // observer methods
    public function replyUpdateError($errors)
    {
        return $this->redirectBack(['errors' => $errors]);
    }

    public function replyUpdated($reply)
    {
        return $this->redirectAction('ForumThreadsController@getShowThread', [$reply->thread->slug]);
    }

    // reply deletion
    public function getDelete($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if ( ! $reply->isManageableBy(Auth::user())) {
            return Redirect::to('/');
        }

        $this->title = "Reactie verwijderen";
        $this->view('forum.replies.delete', compact('reply'));
    }

    public function postDelete($replyId)
    {
        $reply = $this->replies->requireById($replyId);

        if ( ! $reply->isManageableBy(Auth::user())) {
            return Redirect::to('/');
        }

        return App::make('GSVnet\Forum\Replies\ReplyDeleter')->delete($this, $reply);
    }

    // observer methods
    public function replyDeleted($thread)
    {
        return Redirect::action('ForumThreadsController@getShowThread', [$thread->slug]);
    }

    // ------------------------- //
    private function prepareViewData()
    {
        $forumSections = Config::get('forum.sections');
        View::share(compact('forumSections'));
    }
}
