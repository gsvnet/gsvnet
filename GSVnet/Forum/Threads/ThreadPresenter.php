<?php namespace GSVnet\Forum\Threads;

use Laracasts\Presenter\Presenter;
use App;
use Str;
use Carbon\Carbon, Auth;

class ThreadPresenter extends Presenter
{
    public function url()
    {
        if ( ! $this->slug) {
            return '';
        }
        return action('ForumThreadsController@getShowThread', [$this->slug]);
    }

    public function likeClass()
    {
        if(! Auth::check() )
            return '';

        if($this->likes->isEmpty())
            return '';

        return 'liked';
    }

    public function created_ago()
    {
        return $this->created_at->diffForHumans();
    }

    public function updated_ago()
    {
        return $this->updated_at->diffForHumans();
    }

    public function bodyFormatted()
    {
        $body = $this->body;
        $body = $this->convertMarkdown($body);
        $body = $this->convertEmoticons($body);
        $body = $this->purify($body);
        return $body;
    }

    public function subject()
    {
        return $subject = Str::limit($this->subject, 80);
    }

    public function mostRecentReplier()
    {
        if ( ! $this->mostRecentReply) {
            return null;
        }
        $this->AprilFools($this->mostRecentReply, true);
        return $this->mostRecentReply->author->username;
    }

    public function latestReplyUrl()
    {
        if ( ! $this->mostRecentReply) {
            return $this->url;
        }

        $page = ceil($this->reply_count / 20);
        $id = $this->most_recent_reply_id;
        $url = $this->url;
        
        if( $page > 1)
        {
            $url .= '?page=' . $page;
        }

        $url .= '#reactie-' . $id;

        return $url;
    }

    public function lastPageUrl()
    {
        $page = ceil($this->reply_count / 20);
        $url = $this->url;
        
        if( $page > 1)
        {
            $url .= '?page=' . $page;
        }

        return $url;
    }

    public function editUrl()
    {
        return action('ForumThreadsController@getEditThread', [$this->id]);
    }

    public function deleteUrl()
    {
        return action('ForumThreadsController@getDelete', [$this->id]);
    }

    public function replyCounter()
    {
        $count = $this->reply_count;
        $class = 'media-counter';
        if($count >= 100)
        {
            $class .= ' small';
        }

        return '<a class="' . $class . '" href="' . $this->lastPageUrl . '">' . $count . '</a>';
    }

    public function visited()
    {
        if( !Auth::check() )
            return '';

        $visitations = $this->visitations;
        $mostRecentReply = $this->mostRecentReply;

        if( ! isset($visitations) || $visitations->count() == 0)
            return 'new';

        if( !isset($mostRecentReply) )
            $updated = $this->created_at;
        else
            $updated = $this->mostRecentReply->created_at;

        $lastVisit = new Carbon($visitations[0]->visited_at);

        if( $updated->gt($lastVisit) )
            return 'new';

        return '';
    }

    private function convertMarkdown($content)
    {
        return App::make('GSVnet\Markdown\HtmlMarkdownConverter')->convertMarkdownToHtml($content);
    }

    private function convertEmoticons($content)
    {
        return App::make('GSVnet\Emoticons\Emoticon')->toHTML($content);
    }

    private function purify($content)
    {
        return App::make('Chromabits\Purifier\Contracts\Purifier')->clean($content);
    }

    private function AprilFools( $threadsOrReplies, $singular = false )
    {
        $aprilFirst = Carbon::create( 2017, 4, 1, 4, 30, 1 );
        $now = Carbon::now();

        //Check user validation
        if ( !$now->gte($aprilFirst) && ( !\Gate::allows('admin') || Auth::user()->profile->company != "Webcie BV" )) return;

        if( $singular ) $threadsOrReplies = array( $threadsOrReplies );

        foreach ($threadsOrReplies as $index => $item) {
            //Check correct item date range
            $itemCreated = Carbon::createFromFormat( 'Y-m-d H:i:s', $item->created_at );
            $referenceDay = $now->gte( $aprilFirst ) ? $aprilFirst : $now;

            //If its not yet april 1, mutate items up to 24 hours back. Otherwise, mutate items upto 24 hours before april 1.
            if ( $itemCreated->addDays(1)->lt( $referenceDay) ) continue;

            if(!Auth::check() || $item->author->id != Auth::user()->id ) {
            
                $identityId = \DB::table( 'april_fools' )->where( 'author_id', $item->author->id )->value( 'identity_id' );
                
                if ( $identityId && (!Auth::check() || $identityId != Auth::user()->id) ) $item->author = \GSVnet\Users\User::find( $identityId );
            }
        }
    }
}
