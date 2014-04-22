<?php namespace GSVnet\Forum\Threads;

use GSVnet\User;
use Auth;
use GSVnet\Core\Entity;
use GSVnet\Forum\Replies\Reply;

class Thread extends Entity
{
    protected $table      = 'forum_threads';
    protected $fillable   = ['subject', 'body', 'author_id', 'solution_reply_id', 'category_slug', 'public'];
    protected $with       = ['author', 'mostRecentReply'];
    protected $softDelete = true;

    public $presenter = 'GSVnet\Forum\Threads\ThreadPresenter';

    protected $validationRules = [
        'body'      => 'required',
        'author_id' => 'required|exists:users,id',
    ];

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

    public function setSubjectAttribute($subject)
    {
        $this->attributes['subject'] = $subject;
        $this->attributes['slug'] = $this->generateNewSlug();
    }

    public function generateNewSlug()
    {
        $i = 0;

        while ($this->getCountBySlug($this->generateSlugByIncrementer($i)) > 0) {
            $i++;
        }

        return $this->generateSlugByIncrementer($i);
    }

    private function getCountBySlug($slug)
    {
        $query = static::where('slug', '=', $slug);

        if ($this->exists) {
            $query->where('id', '!=', $this->id);
        }

        return $query->count();
    }

    private function generateSlugByIncrementer($i)
    {
        if ($i == 0) $i = '';

        if ($this->created_at) {
            $date = date('d-m-Y', strtotime($this->created_at));
        } else {
            $date = date('d-m-Y');
        }

        return \Str::slug("{$date} - {$this->subject}" . $i);
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

    public function setMostRecentReply(Reply $reply)
    {
        $this->most_recent_reply_id = $reply->id;
        $this->updateReplyCount();
        $this->save();
    }

    public function updateReplyCount()
    {
        if ($this->exists) {
            $this->reply_count = $this->replies()->count();
            $this->save();
        }
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
