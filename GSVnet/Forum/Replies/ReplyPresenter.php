<?php namespace GSVnet\Forum\Replies;

use Illuminate\Support\Facades\Auth;
use Laracasts\Presenter\Presenter;
use App;
use GSVnet\Carbon as GSVCarbon;

class ReplyPresenter extends Presenter
{
    // don't use this with $thread->replies, because it fires 4 queries per reply extra
    public function url()
    {

        $slug = $this->thread->slug;
        $threadUrl = action('ForumThreadsController@getShowThread', [$slug]);

        return $threadUrl . \App::make('GSVnet\Forum\Replies\ReplyQueryStringGenerator')->generate( $this->entity );
    }

    public function likeClass()
    {
        if(! Auth::check() )
            return '';

        $likes = $this->likes;

        if(! $likes)
            return '';

        return 'liked';
    }

    public function created_ago()
    {
        $created = new GSVCarbon($this->created_at);
        return $created->diffForHumans();
    }

    public function updated_ago()
    {
        $updated = new GSVCarbon($this->updated_at);
        return $updated->diffForHumans();
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
