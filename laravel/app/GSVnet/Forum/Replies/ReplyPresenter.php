<?php namespace GSVnet\Forum\Replies;

use McCool\LaravelAutoPresenter\BasePresenter;
use App, Input, Str, Request;

class ReplyPresenter extends BasePresenter
{
    public function url()
    {
        $slug = $this->thread->slug;
        $threadUrl = action('ForumThreadsController@getShowThread', [$slug]);
        return $threadUrl . \App::make('GSVnet\Forum\Replies\ReplyQueryStringGenerator')->generate($this->resource);
    }

    public function created_ago()
    {
        return $this->resource->created_at->diffForHumans();
    }

    public function updated_ago()
    {
        return $this->resource->updated_at->diffForHumans();
    }

    public function body()
    {
        $body = $this->resource->body;
        $body = $this->convertMarkdown($body);
        $body = $this->linkify($body);
        return $body;
    }

    // ------------------- //

    private function convertMarkdown($content)
    {
        return App::make('GSVnet\Markdown\HtmlMarkdownConvertor')->convertMarkdownToHtml($content);
    }

    private function linkify($content)
    {
        $linkify = new \Misd\Linkify\Linkify();
        return $linkify->process($content);
    }
}
