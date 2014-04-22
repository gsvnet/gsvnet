<?php namespace GSVnet\Forum\Threads;

use McCool\LaravelAutoPresenter\BasePresenter;
use App, Input, Str, Request;
use Misd\Linkify\Linkify;
use Carbon\Carbon, Auth;

class ThreadPresenter extends BasePresenter
{
    public function url()
    {
        if ( ! $this->slug) {
            return '';
        }
        return action('ForumThreadsController@getShowThread', [$this->slug]);
    }

    public function created_ago()
    {
        return $this->created_at->diffForHumans();
    }

    public function updated_ago()
    {
        return $this->updated_at->diffForHumans();
    }

    public function body()
    {
        $body = $this->resource->body;
        $body = $this->convertMarkdown($body);
        $body = $this->linkify($body);
        return $body;
    }

    public function subject()
    {
        return $subject = Str::limit($this->resource->subject, 80);
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

        $page = ceil($this->resource->reply_count / 20);
        $id = $this->resource->most_recent_reply_id;
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
        $page = ceil($this->resource->reply_count / 20);
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
        $count = $this->resource->reply_count;
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
        {
            return '';
        }

        if( !isset($this->resource->visitations) )
        {
            return 'new';
        }

        if( !isset($this->resource->mostRecentReply) )
        {
            $updated = $this->resource->created_at;
        } else {
            $updated = $this->resource->mostRecentReply->created_at;
        }

        $visitations = $this->resource->visitations;
        
        if( count($visitations) == 0 )
        {
            return 'new';
        }

        $lastVisit = new Carbon($visitations[0]->visited_at);
        if( $updated->gt($lastVisit) )
        {
            return 'new';
        }

        return '';

    }

    // ------------------- //

    private function convertMarkdown($content)
    {
        return App::make('GSVnet\Markdown\HtmlMarkdownConvertor')->convertMarkdownToHtml($content);
    }

    private function linkify($content)
    {
        $linkify = new Linkify();
        return $linkify->process($content);
    }
}
