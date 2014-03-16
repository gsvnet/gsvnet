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
        return $this->mostRecentReply->author->fullname;
    }

    public function latestReplyUrl()
    {
        if ( ! $this->mostRecentReply) {
            return $this->url;
        }
        return $this->url . App::make('GSVnet\Forum\Replies\ReplyQueryStringGenerator')->generate($this->mostRecentReply);
    }

    public function acceptedSolutionUrl()
    {
        if ( ! $this->acceptedSolution) {
            return null;
        }

        return $this->url . App::make('GSVnet\Forum\Replies\ReplyQueryStringGenerator')->generate($this->acceptedSolution);
    }

    public function editUrl()
    {
        return action('ForumThreadsController@getEditThread', [$this->id]);
    }

    public function deleteUrl()
    {
        return action('ForumThreadsController@getDelete', [$this->id]);
    }

    public function markAsSolutionUrl($replyId)
    {
        return action('ForumThreadsController@getMarkQuestionSolved', [$this->resource->id, $replyId]);
    }

    public function markAsUnsolvedUrl()
    {
        return action('ForumThreadsController@getMarkQuestionUnsolved', [$this->resource->id]);
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