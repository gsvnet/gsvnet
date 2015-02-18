<?php

use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Forum\Threads\ThreadCreator;
use GSVnet\Forum\Threads\ThreadCreatorListener;
use GSVnet\Forum\Threads\ThreadDeleterListener;
use \GSVnet\Forum\Threads\ThreadForm;
use GSVnet\Forum\Threads\ThreadRepository;
use GSVnet\Forum\Threads\ThreadUpdaterListener;
use GSVnet\Tags\TagRepository;
use GSVnet\Users\UsersRepository;
use \Permission;

class ForumThreadsController extends BaseController implements ThreadCreatorListener, ThreadUpdaterListener, ThreadDeleterListener {
    protected $threads;
    protected $tags;
    protected $users;
    protected $currentSection;
    protected $threadCreator;
    private $replies;

    protected $threadsPerPage = 50;
    protected $repliesPerPage = 20;

    public function __construct(ThreadRepository $threads, ReplyRepository $replies, TagRepository $tags, UsersRepository $users, ThreadCreator $threadCreator)
    {
        parent::__construct();

        $this->threads = $threads;
        $this->tags = $tags;
        $this->users = $users;
        $this->threadCreator = $threadCreator;
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
        $this->createSections(Input::get('tags'));

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

        $this->createSections($thread->getTags());
        // Visit the thread
        if( Auth::check() )
            App::make('GSVnet\Forum\Threads\ThreadVisitationUpdater')->update($thread, Auth::user());

        return view('forum.threads.show', compact('thread', 'replies'));
    }

    // create a thread
    public function getCreateThread()
    {
        $tags = $this->tags->getAllForForum();
        $this->createSections(Input::get('tags'));

        return view('forum.threads.create', compact('tags'));
    }

    public function postCreateThread()
    {
        return $this->threadCreator->create($this, [
            'subject' => Input::get('subject'),
            'body' => Input::get('body'),
            'author' => Auth::user(),
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
            'public' => Input::get('public', false)
        ], new ThreadForm);
    }

    public function threadCreationError($errors)
    {
        return redirect()->back()->withErrors($errors);
    }

    public function threadCreated($thread)
    {
        return redirect()->action('ForumThreadsController@getShowThread', [$thread->slug]);
    }

    public function getEditThread($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        if ( ! $thread->isManageableBy(Auth::user()))
            return redirect('/');

        $tags = $this->tags->getAllForForum();

        $this->createSections(Input::get('tags'));

        return view('forum.threads.edit', compact('thread', 'tags'));
    }

    public function postEditThread($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        if ( ! $thread->isManageableBy(Auth::user()))
            return redirect('/');

        return App::make('GSVnet\Forum\Threads\ThreadUpdater')->update($this, $thread, [
            'subject' => Input::get('subject'),
            'body' => Input::get('body'),
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
            'public' => Input::get('public', false)
        ], new ThreadForm);
    }

    // observer methods
    public function threadUpdateError($errors)
    {
        return redirect()->back()->withErrors($errors);
    }

    public function threadUpdated($thread)
    {
        return redirect()->action('ForumThreadsController@getShowThread', [$thread->slug]);
    }

    // thread deletion
    public function getDelete($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        if ( ! $thread->isManageableBy(Auth::user()))
            return redirect('/');

        $this->createSections(Input::get('tags'));

        return view('forum.threads.delete', compact('thread'));
    }

    public function postDelete($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        if ( ! $thread->isManageableBy(Auth::user()))
            return redirect('/');

        return App::make('GSVnet\Forum\Threads\ThreadDeleter')->delete($this, $thread);
    }

    // observer methods
    public function threadDeleted()
    {
        return redirect()->action('ForumThreadsController@getIndex');
    }

    // forum thread search
    public function getSearch()
    {
        $query = Input::get('query');
        $results = App::make('GSVnet\Forum\Threads\ThreadSearch')->searchPaginated($query, $this->threadsPerPage);
        $results->appends(array('query' => $query));

        $this->createSections(Input::get('tags'));

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
        $this->createSections();

        return view('forum.threads.thrashed', compact('threads'));
    }

    private function createSections($currentSection = null)
    {
        $forumSections = App::make('GSVnet\Forum\SectionSidebarCreator')->createSidebar($currentSection);
        View::share(compact('forumSections'));
    }
}
