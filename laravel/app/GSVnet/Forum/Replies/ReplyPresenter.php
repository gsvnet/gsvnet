<?php namespace GSVnet\Forum\Replies;

use McCool\LaravelAutoPresenter\BasePresenter;
use App, Input, Str, Request, Purifier;

class ReplyPresenter extends BasePresenter
{
    // don't use this with $thread->replies, because it fires 4 queries per reply extra
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
        $body = $this->convertEmoticons($body);
        $body = $this->purify($body);
        return $body;
    }

    // ------------------- //

    private function convertMarkdown($content)
    {
        return App::make('GSVnet\Markdown\HtmlMarkdownConvertor')->convertMarkdownToHtml($content);
    }

    private function convertEmoticons($content)
    {
        return App::make('GSVnet\Emoticons\EmoticonsConverter')->convertEmoticionsToHTML($content);
    }

    private function linkify($content)
    {
        $linkify = new \Misd\Linkify\Linkify();
        return $linkify->process($content);
    }

    private function purify($content)
    {
        return Purifier::clean($content);
    }
}
