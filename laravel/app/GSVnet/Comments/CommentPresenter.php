<?php namespace GSVnet\Comments;

use McCool\LaravelAutoPresenter\BasePresenter;
use App, Input, Str, Request;

class CommentPresenter extends BasePresenter
{
    public function forumThreadUrl()
    {
        $slug = $this->resource->slug;
        if ( ! $slug) return '';
        return action('ForumThreadsController@getShowThread', [$slug->slug]);
    }

    public function commentUrl()
    {
        $pagination = null;
        $slug = $this->resource->parent->slug;
        if ( ! $slug) return '';

        $url = action('ForumRepliesController@getCommentRedirect', [$slug->slug, $this->id]);
        return $url;
    }

    public function child_count_label()
    {
        if ($this->resource->child_count == 0) {
            return '0 reacties';
        } elseif($this->resource->child_count == 1) {
            return '1 reactie';
        }

        return $this->resource->child_count . ' reacties';
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
        $body = $this->convertNewlines($body);
        $body = $this->linkify($body);
        return $body;
    }

    public function bodySummary()
    {
        $summary = Str::words($this->resource->body, 50);
        return App::make('GSVnet\Markdown\HtmlMarkdownConvertor')->convertMarkdownToHtml($summary);
    }

    // ------------------- //

    private function convertMarkdown($content)
    {
        return App::make('GSVnet\Markdown\HtmlMarkdownConvertor')->convertMarkdownToHtml($content);
    }

    private function convertNewlines($content)
    {
        return str_replace("\n\n", '<br/>', $content);
    }

    private function linkify($content)
    {
        $linkify = new \Misd\Linkify\Linkify();
        return $linkify->process($content);
    }
}