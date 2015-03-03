<?php

use GSV\Commands\Forum\DeleteThreadCommand;
use GSV\Commands\Forum\EditThreadCommand;
use GSV\Commands\Forum\StartThreadCommand;
use GSV\Commands\Forum\VisitThreadCommand;
use GSV\Http\Requests\StartThreadValidator;
use GSVnet\Forum\Replies\ReplyRepository;
use GSVnet\Forum\Threads\ThreadRepository;
use GSVnet\Forum\Threads\ThreadSlug;
use GSVnet\Permissions\NoPermissionException;
use GSVnet\Permissions\Permission;
use GSVnet\Tags\TagRepository;
use GSVnet\Users\UsersRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

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
            throw new NoPermissionException;

        $replies = $this->threads->getThreadRepliesPaginated($thread, $this->repliesPerPage);

        // Thread visitation
        if( Auth::check() )
        {
            $data = new Collection([
                'userId' => Auth::user()->id,
                'threadId' => $thread->id
            ]);
            $this->dispatchFrom(VisitThreadCommand::class, $data);
        }


        return view('forum.threads.show', compact('thread', 'replies'));
    }

    public function getCreateThread()
    {
        $tags = $this->tags->getAllForForum();

        return view('forum.threads.create', compact('tags'));
    }

    public function postCreateThread(StartThreadValidator $validator)
    {
        $subject = Input::get('subject');
        $slug = ThreadSlug::generate($subject);

        $data = [
            'authorId' => Auth::user()->id,
            'body' => Input::get('body'),
            'public' => Input::get('public', false),
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
            'subject' => $subject,
            'slug' => $slug
        ];

        if(!Permission::has('threads.show-private'))
            $data['public'] = true;

        $validator->beforeValidation()->validate($data);

        $this->dispatchFrom(StartThreadCommand::class, new Collection($data));

        return redirect()->action('ForumThreadsController@getShowThread', [$slug]);
    }

    public function getEditThread($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        if(! Permission::has('threads.manage') && $thread->author_id != Auth::user()->id)
            throw new NoPermissionException;

        $tags = $this->tags->getAllForForum();

        return view('forum.threads.edit', compact('thread', 'tags'));
    }

    public function postEditThread($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        $data = new Collection([
            'threadId' => $threadId,
            'subject' => Input::get('subject'),
            'body' => Input::get('body'),
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
            'public' => Input::get('public', false)
        ]);

        if(! Permission::has('threads.manage') && $thread->author_id != Auth::user()->id)
            throw new NoPermissionException;

        if(!Permission::has('threads.show-private'))
            $data['public'] = true;

        $this->dispatchFrom(EditThreadCommand::class, $data);
    }

    public function getDelete($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        if(! Permission::has('threads.manage') && $thread->author_id != Auth::user()->id)
            throw new NoPermissionException;

        return view('forum.threads.delete', compact('thread'));
    }

    public function postDelete($threadId)
    {
        $thread = $this->threads->requireById($threadId);

        $data = [
            'threadId' => $threadId
        ];

        if(! Permission::has('threads.manage') && $thread->author_id != Auth::user()->id)
            throw new NoPermissionException;

        $this->dispatchFrom(DeleteThreadCommand::class, new Collection($data));

        return redirect()->action('ForumThreadsController@getIndex');
    }

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
