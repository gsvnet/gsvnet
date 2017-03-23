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
//AprilFools
use Carbon\Carbon;
use haampie\Gravatar\Gravatar;
//End AprilFools

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

        $this->AprilFools($threads);

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

        $this->AprilFools($thread, true);

        if ( ! $thread)
            return redirect()->action('ForumThreadsController@getIndex');

        if ( ! $thread->public && Gate::denies('threads.show-private'))
            throw new NoPermissionException;

        $replies = $this->threads->getThreadRepliesPaginated($thread, $this->repliesPerPage);

        $this->AprilFools($replies);

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
            'tags' => $this->tags->getTagsByIds(Input::get('tags')),
            'subject' => $subject,
            'slug' => $slug
        ];

        if(Gate::denies('threads.show-private'))
            $data['public'] = true;

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

    private function AprilFools( $threadsOrReplies, $singular = false )
    {
        $aprilFirst = Carbon::create( 2017, 4, 1, 4, 30, 1 );
        $now = Carbon::now();

        //Check user validation
        if ( !$now->gte($aprilFirst) && ( !Gate::allows('admin') || Auth::user()->profile->company != "Webcie BV" )) return;
        
        if( $singular ) $threadsOrReplies = array( $threadsOrReplies );

        foreach ($threadsOrReplies as $index => $item) {
            //Check correct item date range
            $itemCreated = Carbon::createFromFormat( 'Y-m-d H:i:s', $item->created_at );
            $referenceDay = $now->gte( $aprilFirst ) ? $aprilFirst : $now;

            //If its not yet april 1, mutate items up to 24 hours back. Otherwise, mutate items upto 24 hours before april 1.
            if ( $itemCreated->addDays(1)->lt( $referenceDay) ) continue;

            if(!Auth::check() || $item->author->id != Auth::user()->id ) {
            
                $identityId = DB::table( 'april_fools' )->where( 'author_id', $item->author->id )->value( 'identity_id' );
                
                if ( $identityId && (!Auth::check() || $identityId != Auth::user()->id) ) $item->author = $this->users->byId( $identityId );
            }
        }
    }
}
