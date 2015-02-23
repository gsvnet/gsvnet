<?php namespace GSVnet\Forum\Threads;

use GSVnet\Forum\LikableTrait;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Thread extends Model
{
    use PresentableTrait;
    use SoftDeletes;
    use LikableTrait;
    
    protected $table = 'forum_threads';
    protected $fillable = ['subject', 'body', 'author_id', 'solution_reply_id', 'slug', 'public'];
    protected $with = ['author'];
    protected $dates = ['deleted_at'];

    public $presenter = 'GSVnet\Forum\Threads\ThreadPresenter';

    public function author()
    {
        return $this->belongsTo('GSVnet\Users\User', 'author_id');
    }

    public function replies()
    {
        return $this->hasMany('GSVnet\Forum\Replies\Reply', 'thread_id');
    }

    public function tags()
    {
        return $this->belongsToMany('GSVnet\Tags\Tag', 'tagged_items', 'thread_id', 'tag_id');
    }

    public function visitations()
    {
        return $this->hasMany('GSVnet\Forum\Threads\ThreadVisitation', 'thread_id');
    }

    public function mostRecentReply()
    {
        return $this->belongsTo('GSVnet\Forum\Replies\Reply', 'most_recent_reply_id');
    }

    public function isManageableBy($user)
    {
        if ( ! $user) return false;
        return $this->isOwnedBy($user) || $user->isForumAdmin();
    }

    public function isOwnedBy($user)
    {
        if ( ! $user) return false;
        return $user->id == $this->author_id;
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

}
