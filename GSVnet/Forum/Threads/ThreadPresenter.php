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

    public function replyCounterList()
    {
        return $this->reply_count + 1;
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
}
