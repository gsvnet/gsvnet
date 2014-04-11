<?php namespace GSVnet\Forum\Threads;

use McCool\LaravelAutoPresenter\BasePresenter;
use App, Input, Str, Request;
use Misd\Linkify\Linkify;

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

        $page = 1 + floor($this->resource->reply_count / 20);
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
        $page = 1 + floor($this->resource->reply_count / 20);
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

        return '<span class="' . $class . '">' . $count . '</span>';
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
