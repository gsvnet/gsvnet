<?php

namespace App\Helpers\Forum\Replies;

use App\Helpers\Emoticons\Emoticon;
use App\Helpers\Markdown\HtmlMarkdownConverter;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Support\Facades\Auth;
use Laracasts\Presenter\Presenter;

class ReplyPresenter extends Presenter
{
    // don't use this with $thread->replies, because it fires 4 queries per reply extra
    public function url()
    {
        $slug = $this->thread->slug;
        $threadUrl = action('ForumThreadsController@getShowThread', [$slug]);

        return $threadUrl.app(ReplyQueryStringGenerator::class)->generate($this->entity);
    }

    public function likeClass()
    {
        if (! Auth::check()) {
            return '';
        }

        if ($this->likes->isEmpty()) {
            return '';
        }

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

    private function convertMarkdown($content)
    {
        return app(HtmlMarkdownConverter::class)->convertMarkdownToHtml($content);
    }

    private function convertEmoticons($content)
    {
        return app(Emoticon::class)->toHTML($content);
    }

    private function purify($content)
    {
        return app(Purifier::class)->clean($content);
    }
}
