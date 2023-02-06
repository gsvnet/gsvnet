<?php namespace App\Helpers\Forum\Threads;

use App\Helpers\Forum\LikableTrait;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use PresentableTrait;
    use SoftDeletes;
    use LikableTrait;
    
    protected $table = 'forum_threads';
    protected $fillable = ['subject', 'body', 'author_id', 'slug', 'public', 'private'];
    protected $with = ['author'];
    protected $dates = ['deleted_at'];

    public $presenter = \App\Helpers\Forum\Threads\ThreadPresenter::class;

    public function author()
    {
        return $this->belongsTo(\App\Helpers\Users\User::class, 'author_id');
    }

    public function replies()
    {
        return $this->hasMany(\App\Helpers\Forum\Replies\Reply::class, 'thread_id');
    }

    public function tags()
    {
        return $this->belongsToMany(\App\Helpers\Tags\Tag::class, 'tagged_items', 'thread_id', 'tag_id');
    }

    public function visitations()
    {
        return $this->hasMany(\App\Helpers\Forum\Threads\ThreadVisitation::class, 'thread_id');
    }

    public function mostRecentReply()
    {
        return $this->belongsTo(\App\Helpers\Forum\Replies\Reply::class, 'most_recent_reply_id');
    }

    public function setTags(array $tagIds)
    {
        $this->tags()->sync($tagIds);
    }

    public function hasTag($tagId)
    {
        return $this->tags->contains($tagId);
    }

    public function getTags()
    {
        return $this->tags->lists('slug');
    }

    public function scopePublic($query)
    {
        return $query->wherePublic(true);
    }

    public function getPublicAttribute($value)
    {
        return $value == 1 ? true : null;
    }

    public function getPrivateAttribute($value)
    {
        return $value == 1 ? true : null;
    }

    public function getReplyIndex($replyId)
    {
        return $this->replies()->where('id', '<', $replyId)->count();
    }

    public function getReplyPageNumber($replyId, $repliesPerPage)
    {
        return (int)($this->getReplyIndex($replyId) / $repliesPerPage + 1);
    }
}
