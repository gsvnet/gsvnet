<?php

use GSV\Commands\Forum\DeleteThreadCommand;
use GSV\Commands\Forum\EditThreadCommand;
use GSV\Commands\Forum\StartThreadCommand;
use GSV\Commands\Forum\VisitThreadCommand;
use GSV\Http\Validators\StartThreadValidator;
use GSVnet\Events\EventsRepository;
use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Forum\Threads\ThreadRepository;
use GSVnet\Forum\Threads\ThreadSearch;
use GSVnet\Forum\Threads\ThreadSlug;
use GSVnet\Permissions\NoPermissionException;
use GSVnet\Tags\TagRepository;
use GSVnet\Users\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;

class ForumThreadsController extends BaseController {
    protected $threads;
    protected $tags;
    protected $users;
    private $replies;

    protected $threadsPerPage = 50;
    protected $repliesPerPage = 20;

    public function __construct(ThreadRepository $threads, ReplyRepository $replies, TagRepository $tags, UsersRepository $users, EventsRepository $events)
    {
        parent::__construct();

        $this->threads = $threads;
        $this->tags = $tags;
        $this->users = $users;
        $this->replies = $replies;

        $events = $events->upcoming(5);

        View::share('events', $events);
    }

    // show thread list - clean this method
    public function getIndex()
    {
        // query tags and retrieve the appropriate threads
        $tags = $this->tags->getAllTagsBySlug(Input::get('tags'));
        $threads = $this->threads->getByTagsPaginated($tags, $this->threadsPerPage);

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

        //return $thread;

        if ( ! $thread)
            return redirect()->action('ForumThreadsController@getIndex');

        if (
            (!$thread->public && Gate::denies('threads.show-private')) ||
            ($thread->atv && Gate::denies('threads.show-atv'))
        )
            throw new NoPermissionException;

        $replies = $this->threads->getThreadRepliesPaginated($thread, $this->repliesPerPage);

        if( Auth::check() )
        {
           if (Auth::user()->approved)
           {
               $author = Auth::user();
           }

            // Thread visitation
            $this->dispatchFromArray(VisitThreadCommand::class, [
                'userId' => Auth::user()->id,
                'threadId' => $thread->id
            ]);
        }

        return view('forum.threads.show', compact('thread', 'replies', 'author'));
    }

    public function getCreateThread()
    {
        $tags = $this->tags->getAllForForum();

        if( Auth::check() )
        {
           if (Auth::user()->approved)
           {
               $author = Auth::user();
           }
        }

        return view('forum.threads.create', compact('tags', 'author'));
    }

    public function postCreateThread(StartThreadValidator $validator)
    {
        $subject = Input::get('subject');
        $slug = ThreadSlug::generate($subject);

        $data = [
            'authorId' => Auth::user()->id,
            'body' => Input::get('body'),
            'public' => Input::get('public', false),
            'atv' => Input::get('atv', false),
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
            'subject' => $subject,
            'slug' => $slug
        ];

        if (Gate::denies('threads.show-atv')) {
            $data['public'] = true;
            $data['atv'] = false;
        }

        $validator->beforeValidation()->validate($data);

        $this->dispatchFromArray(StartThreadCommand::class, $data);

        return redirect()->action('ForumThreadsController@getShowThread', [$slug]);
    }

    public function getEditThread($threadId)
    {
        $thread = $this->threads->requireById($threadId);
        $author = $thread->author;

        $this->authorize('thread.manage', $thread);

        $tags = $this->tags->getAllForForum();

        return view('forum.threads.edit', compact('thread', 'tags', 'author'));
    }

    public function postEditThread(Request $request, $threadId)
    {
        $thread = $this->threads->requireById($threadId);

        $this->authorize('thread.manage', $thread);

        $data = [
            'threadId' => $threadId,
            'subject' => $request->get('subject'),
            'body' => $request->get('body'),
            'tags' => $this->tags->getTagsByIds($request->get('tags')),
            'public' => $request->exists('public')
        ];

        if(Gate::denies('threads.show-private'))
            $data['public'] = true;

        $this->dispatchFromArray(EditThreadCommand::class, $data);

        return redirect()->action('ForumThreadsController@getShowThread', [$thread->slug]);
    }

    public function getDelete($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        $this->authorize('thread.manage', $thread);

        return view('forum.threads.delete', compact('thread'));
    }

    public function postDelete($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        $this->authorize('thread.manage', $thread);

        $this->dispatchFromArray(DeleteThreadCommand::class, [
            'threadId' => $threadId
        ]);

        return redirect()->action('ForumThreadsController@getIndex');
    }

    public function getSearch()
    {
        $query = Input::get('query');
        $results = app(ThreadSearch::class)->searchPaginated($query, $this->threadsPerPage);
        $results->appends(['query' => $query]);

        return view('forum.search', compact('query', 'results'));
    }

    public function statistics()
    {
        $perMonthUsers = $this->users->mostPostsPreviousMonth();
        $perWeekUsers = $this->users->mostPostsPreviousWeek();
        $allTimeUsers = $this->users->mostPostsAllTime();
        $likesGiven = $this->threads->totalLikesGivenPerYearGroup();
        $likesReceived = $this->threads->totalLikesReceivedPerYearGroup();

        return view('forum.stats', compact(
            'perMonthUsers',
            'perWeekUsers',
            'allTimeUsers',
            'likesGiven',
            'likesReceived'
        ));
    }

    public function getTrashed()
    {
        $this->authorize('thread.manage');

        $threads = $this->threads->getTrashedPaginated();

        return view('forum.threads.thrashed', compact('threads'));
    }
}
