<?php

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Commands\Forum\DeleteThreadCommand;
use App\Commands\Forum\EditThreadCommand;
use App\Commands\Forum\StartThreadCommand;
use App\Commands\Forum\VisitThreadCommand;
use App\Helpers\Events\EventsRepository;
use App\Helpers\Forum\Replies\ReplyRepository;
use App\Helpers\Forum\Threads\ThreadRepository;
use App\Helpers\Forum\Threads\ThreadSearch;
use App\Helpers\Forum\Threads\ThreadSlug;
use App\Helpers\Permissions\NoPermissionException;
use App\Helpers\Tags\TagRepository;
use App\Helpers\Users\UsersRepository;
use App\Http\Validators\StartThreadValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\View;

class ForumThreadsController extends BaseController
{
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
    public function getIndex(): View
    {
        // query tags and retrieve the appropriate threads
        $tags = $this->tags->getAllTagsBySlug(Input::get('tags'));
        $threads = $this->threads->getByTagsPaginated($tags, $this->threadsPerPage);

        // add the tag string to each pagination link
        $tagAppends = ['tags' => Input::get('tags')];
        $queryString = ! empty($tagAppends['tags']) ? '?tags='.implode(',', (array) $tagAppends['tags']) : '';
        $threads->appends($tagAppends);

        return view('forum.threads.index', compact('threads', 'tags', 'queryString'));
    }

    // show a thread
    public function getShowThread($threadSlug)
    {
        $thread = $this->threads->getBySlug($threadSlug);

        //return $thread;

        if (! $thread) {
            return redirect()->action([\App\Http\Controllers\ForumThreadsController::class, 'getIndex']);
        }

        if (! $thread->public && Gate::denies('threads.show-internal')) {
            throw new NoPermissionException;
        }

        if ($thread->private && Gate::denies('threads.show-private')) {
            throw new NoPermissionException;
        }

        $replies = $this->threads->getThreadRepliesPaginated($thread, $this->repliesPerPage);

        if (Auth::check()) {
            if (Auth::user()->approved) {
                $author = Auth::user();
            }

            // Thread visitation
            $this->dispatchFromArray(VisitThreadCommand::class, [
                'userId' => Auth::user()->id,
                'threadId' => $thread->id,
            ]);
        }

        return view('forum.threads.show', compact('thread', 'replies', 'author'));
    }

    public function getCreateThread(): View
    {
        $tags = $this->tags->getAllForForum();

        if (Auth::check()) {
            if (Auth::user()->approved) {
                $author = Auth::user();
            }
        }

        return view('forum.threads.create', compact('tags', 'author'));
    }

    public function postCreateThread(StartThreadValidator $validator): RedirectResponse
    {
        $subject = Input::get('subject');
        $slug = ThreadSlug::generate($subject);
        $visibility = Input::get('visibility', 'internal');

        $data = [
            'authorId' => Auth::user()->id,
            'body' => Input::get('body'),
            'public' => $visibility == 'public',
            'private' => $visibility == 'private',
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
            'subject' => $subject,
            'slug' => $slug,
        ];

        if (Gate::denies('threads.show-internal')) {
            $data['public'] = true;
        }

        if (Gate::denies('threads.show-private')) {
            $data['private'] = false;
        }

        $validator->beforeValidation()->validate($data);

        $this->dispatchFromArray(StartThreadCommand::class, $data);

        return redirect()->action([\App\Http\Controllers\ForumThreadsController::class, 'getShowThread'], [$slug]);
    }

    public function getEditThread($threadId): View
    {
        $thread = $this->threads->requireById($threadId);
        $author = $thread->author;

        $this->authorize('thread.manage', $thread);

        $tags = $this->tags->getAllForForum();

        $visibility = ($thread->public ? 'public' : ($thread->private ? 'private' : 'internal'));

        return view('forum.threads.edit', compact('thread', 'tags', 'author', 'visibility'));
    }

    public function postEditThread(Request $request, $threadId): RedirectResponse
    {
        $thread = $this->threads->requireById($threadId);

        $this->authorize('thread.manage', $thread);

        $visibility = $request->get('visibility', 'internal');
        $data = [
            'threadId' => $threadId,
            'subject' => $request->get('subject'),
            'body' => $request->get('body'),
            'tags' => $this->tags->getTagsByIds($request->get('tags')),
            'public' => $visibility == 'public',
            'private' => $visibility == 'private',
        ];

        if (Gate::denies('threads.show-internal')) {
            $data['public'] = true;
        }

        if (Gate::denies('threads.show-private')) {
            $data['private'] = false;
        }

        $this->dispatchFromArray(EditThreadCommand::class, $data);

        return redirect()->action([\App\Http\Controllers\ForumThreadsController::class, 'getShowThread'], [$thread->slug]);
    }

    public function getDelete($threadId): View
    {
        $thread = $this->threads->requireById($threadId);

        $this->authorize('thread.manage', $thread);

        return view('forum.threads.delete', compact('thread'));
    }

    public function postDelete($threadId): RedirectResponse
    {
        $thread = $this->threads->requireById($threadId);

        $this->authorize('thread.manage', $thread);

        $this->dispatchFromArray(DeleteThreadCommand::class, [
            'threadId' => $threadId,
        ]);

        return redirect()->action([\App\Http\Controllers\ForumThreadsController::class, 'getIndex']);
    }

    public function getSearch(): View
    {
        $query = Input::get('query');
        $replies = Input::get('replies');

        $results = app(ThreadSearch::class)->searchPaginated($query, $replies, $this->threadsPerPage);
        $results->appends(['query' => $query]);

        return view('forum.search', compact('query', 'results'));
    }

    public function statistics(): View
    {
        $perMonthUsers = $this->users->mostPostsPreviousMonth();
        $perWeekUsers = $this->users->mostPostsPreviousWeek();
        $allTimeUsers = $this->users->mostPostsAllTime();
        $allTimeUser = $this->users->postsAllTimeUser(Auth::user()->id);
        $allTimeUserRank = $this->users->postsAllTimeUserRank($allTimeUser);
        $likesGiven = $this->threads->totalLikesGivenPerYearGroup();
        $likesReceived = $this->threads->totalLikesReceivedPerYearGroup();

        return view('forum.stats', compact(
            'perMonthUsers',
            'perWeekUsers',
            'allTimeUsers',
            'likesGiven',
            'likesReceived',
            'allTimeUser',
            'allTimeUserRank'
        ));
    }

    public function getTrashed(): View
    {
        $this->authorize('thread.manage');

        $threads = $this->threads->getTrashedPaginated();

        return view('forum.threads.thrashed', compact('threads'));
    }
}
