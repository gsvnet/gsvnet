<?php

use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Forum\Threads\ThreadCreator;
use GSVnet\Forum\Threads\ThreadCreatorListener;
use GSVnet\Forum\Threads\ThreadDeleterListener;
use \GSVnet\Forum\Threads\ThreadForm;
use GSVnet\Forum\Threads\ThreadRepository;
use GSVnet\Forum\Threads\ThreadUpdaterListener;
use GSVnet\Tags\TagRepository;

class ForumThreadsController extends BaseController implements
    ThreadCreatorListener,
    ThreadUpdaterListener,
    ThreadDeleterListener
{
    protected $threads;
    protected $tags;
    protected $currentSection;
    protected $threadCreator;
    private $replies;

    protected $threadsPerPage = 50;
    protected $repliesPerPage = 20;

    public function __construct(
        ThreadRepository $threads,
        ReplyRepository $replies,
        TagRepository $tags,
        ThreadCreator $threadCreator
    )
    {
        parent::__construct();

        $this->threads = $threads;
        $this->tags = $tags;
        $this->threadCreator = $threadCreator;
        $this->replies = $replies;
    }

    // show thread list - clean this method
    public function getIndex()
    {
        // query tags and retrieve the appropriate threads
        $tags = $this->tags->getAllTagsBySlug(Input::get('tags'));
        $threads = $this->threads->getByTagsAndStatusPaginated($tags, '', $this->threadsPerPage);

        // add the tag string to each pagination link
        $tagAppends = ['tags' => Input::get('tags')];
        $queryString = !empty($tagAppends['tags']) ? '?tags=' . implode(',', (array)$tagAppends['tags']) : '';
        $threads->appends($tagAppends);
        $this->createSections(Input::get('tags'));

        $this->title = "Forum";
        $this->view('forum.threads.index', compact('threads', 'tags', 'queryString'));
        $this->layout->activeMenuItem = 'forum';
    }

    // show a thread
    public function getShowThread($threadSlug)
    {
        $thread = $this->threads->getBySlug($threadSlug);

        if ( ! $thread) {
            return $this->redirectAction('ForumThreadsController@getIndex');
        }

        $replies = $this->threads->getThreadRepliesPaginated($thread, $this->repliesPerPage);

        $this->createSections($thread->getTags());

        $this->title = ($thread->isSolved() ? '[SOLVED] ' : '') . $thread->subject;
        $this->view('forum.threads.show', compact('thread', 'replies'));
        $this->layout->activeMenuItem = 'forum';
    }

    // create a thread
    public function getCreateThread()
    {
        $tags = $this->tags->getAllForForum();
        $this->createSections(Input::get('tags'));

        $this->title = "Create Forum Thread";
        $this->view('forum.threads.create', compact('tags'));
        $this->layout->activeMenuItem = 'forum';

    }

    public function postCreateThread()
    {
        return $this->threadCreator->create($this, [
            'subject' => Input::get('subject'),
            'body' => Input::get('body'),
            'author' => Auth::user(),
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
        ], new ThreadForm);
    }

    public function threadCreationError($errors)
    {
        return $this->redirectBack(['errors' => $errors]);
    }

    public function threadCreated($thread)
    {
        return $this->redirectAction('ForumThreadsController@getShowThread', [$thread->slug]);
    }

    // edit a thread
    public function getEditThread($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        if ( ! $thread->isManageableBy(Auth::user())) {
            return Redirect::to('/');
        }

        $tags = $this->tags->getAllForForum();

        $this->createSections(Input::get('tags'));

        $this->title = "Edit Forum Thread";
        $this->view('forum.threads.edit', compact('thread', 'tags'));
        $this->layout->activeMenuItem = 'forum';

    }

    public function postEditThread($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        if ( ! $thread->isManageableBy(Auth::user())) {
            return Redirect::to('/');
        }

        return App::make('GSVnet\Forum\Threads\ThreadUpdater')->update($this, $thread, [
            'subject' => Input::get('subject'),
            'body' => Input::get('body'),
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
        ], new ThreadForm);
    }

    // observer methods
    public function threadUpdateError($errors)
    {
        return $this->redirectBack(['errors' => $errors]);
    }

    public function threadUpdated($thread)
    {
        return $this->redirectAction('ForumThreadsController@getShowThread', [$thread->slug]);
    }

    // thread deletion
    public function getDelete($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        if ( ! $thread->isManageableBy(Auth::user())) {
            return Redirect::to('/');
        }

        $this->createSections(Input::get('tags'));

        $this->title = "Delete Forum Thread";
        $this->view('forum.threads.delete', compact('thread'));
    }

    public function postDelete($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        if ( ! $thread->isManageableBy(Auth::user())) {
            return Redirect::to('/');
        }

        return App::make('GSVnet\Forum\Threads\ThreadDeleter')->delete($this, $thread);
    }

    // observer methods
    public function threadDeleted()
    {
        return Redirect::action('ForumThreadsController@getIndex');
    }

    // forum thread search
    public function getSearch()
    {
        $query = Input::get('query');
        $results = App::make('GSVnet\Forum\Threads\ThreadSearch')->searchPaginated($query, $this->threadsPerPage);
        $results->appends(array('query' => $query));

        $this->createSections(Input::get('tags'));
        $this->title = "Forum Search";
        $this->view('forum.search', compact('query', 'results'));
        $this->layout->activeMenuItem = 'forum';
    }

    // ------------------------- //
    private function createSections($currentSection = null)
    {
        $forumSections = App::make('GSVnet\Forum\SectionSidebarCreator')->createSidebar($currentSection);
        View::share(compact('forumSections'));
    }
}
