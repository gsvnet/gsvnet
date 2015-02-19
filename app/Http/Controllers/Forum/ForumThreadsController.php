<?php

use GSV\Commands\EditThreadCommand;
use GSV\Commands\StartThreadCommand;
use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Forum\Threads\ThreadRepository;
use GSVnet\Tags\TagRepository;
use GSVnet\Users\UsersRepository;
use Illuminate\Support\Collection;
use Permission;

class ForumThreadsController extends BaseController {
    protected $threads;
    protected $tags;
    protected $users;
    private $replies;

    protected $threadsPerPage = 50;
    protected $repliesPerPage = 20;

    public function __construct(ThreadRepository $threads, ReplyRepository $replies, TagRepository $tags, UsersRepository $users)
    {
        parent::__construct();

        $this->threads = $threads;
        $this->tags = $tags;
        $this->users = $users;
        $this->replies = $replies;
    }

    // show thread list - clean this method
    public function getIndex()
    {
        // query tags and retrieve the appropriate threads
        $tags = $this->tags->getAllTagsBySlug(Input::get('tags'));
        $threads = $this->threads->getByTagsPaginated($tags, '', $this->threadsPerPage);


        // add the tag string to each pagination link
        $tagAppends = ['tags' => Input::get('tags')];
        $queryString = !empty($tagAppends['tags']) ? '?tags=' . implode(',', (array)$tagAppends['tags']) : '';
        $threads->appends($tagAppends);

        return view('forum.threads.index', compact('threads', 'tags', 'queryString'));
    }

    // show a thread
    public function getShowThread($threadSlug)
    {
        $thread = $this->threads->getBySlug($threadSlug);

        if ( ! $thread)
            return redirect()->action('ForumThreadsController@getIndex');

        if ( ! $thread->public && ! Permission::has('threads.show-private'))
            throw new \GSVnet\Permissions\NoPermissionException;

        $replies = $this->threads->getThreadRepliesPaginated($thread, $this->repliesPerPage);

        // Visit the thread
        // queue this!
        if( Auth::check() )
            App::make('GSVnet\Forum\Threads\ThreadVisitationUpdater')->update($thread, Auth::user());

        return view('forum.threads.show', compact('thread', 'replies'));
    }

    // create a thread
    public function getCreateThread()
    {
        $tags = $this->tags->getAllForForum();

        return view('forum.threads.create', compact('tags'));
    }

    public function postCreateThread()
    {
        $data = new Collection([
            'authorId' => Auth::user()->id,
            'subject' => Input::get('subject'),
            'body' => Input::get('body'),
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
            'public' => Input::get('public', false)
        ]);

        $this->dispatchFrom(StartThreadCommand::class, $data);
    }

    public function getEditThread($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        $tags = $this->tags->getAllForForum();

        return view('forum.threads.edit', compact('thread', 'tags'));
    }

    public function postEditThread($threadId)
    {
        $data = new Collection([
            'threadId' => $threadId,
            'subject' => Input::get('subject'),
            'body' => Input::get('body'),
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
            'public' => Input::get('public', false)
        ]);

        $this->dispatchFrom(EditThreadCommand::class, $data);
    }

    // thread deletion
    public function getDelete($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        return view('forum.threads.delete', compact('thread'));
    }

    public function postDelete($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        return App::make('GSVnet\Forum\Threads\ThreadDeleter')->delete($this, $thread);
    }

    // forum thread search
    public function getSearch()
    {
        $query = Input::get('query');
        $results = App::make('GSVnet\Forum\Threads\ThreadSearch')->searchPaginated($query, $this->threadsPerPage);
        $results->appends(array('query' => $query));


        return view('forum.search', compact('query', 'results'));
    }

    public function statistics()
    {
        $perMonthUsers = $this->users->mostPostsPreviousMonth();
        $perWeekUsers = $this->users->mostPostsPreviousWeek();
        $allTimeUsers = $this->users->mostPostsAllTime();

        return view('forum.stats', compact('perMonthUsers', 'perWeekUsers', 'allTimeUsers'));
    }

    public function getTrashed()
    {
        $threads = $this->threads->getTrashedPaginated();

        return view('forum.threads.thrashed', compact('threads'));
    }
}
