<?php namespace GSVnet\Comments;

use GSVnet\Core\EloquentRepository;
use GSVnet\Forum\ForumCategory;
use Illuminate\Support\Collection;

class CommentRepository extends EloquentRepository
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    public function getAllThreads()
    {
        $query = $this->model->with(['mostRecentChild', 'tags'])
            ->where('type', '=', COMMENT::TYPE_FORUM)
            ->join('comment_tag', 'comments.id', '=', 'comment_tag.comment_id');


        $query->groupBy('comments.id')
            ->orderBy('updated_at', 'desc');

        return $query->get(['comments.*']);
    }

    public function getForumThreadsByTagsPaginated(Collection $tags, $perPage = 20)
    {
        $query = $this->model->with(['slug', 'mostRecentChild', 'tags'])
            ->where('type', '=', COMMENT::TYPE_FORUM)
            ->join('comment_tag', 'comments.id', '=', 'comment_tag.comment_id');

        if ($tags->count() > 0) {
            $query->whereIn('comment_tag.tag_id', $tags->lists('id'));
        }

        $query->groupBy('comments.id')
            ->orderBy('updated_at', 'desc');

        return $query->paginate($perPage, ['comments.*']);
    }

    public function getThreadCommentsPaginated(Comment $thread, $perPage = 20)
    {
        return $this->model->where(function($q) use ($thread) {

                        $q->orWhere(function($q) use ($thread) {
                            $q->where('parent_id', '=', $thread->id);
                        });
                    })
                    ->where('type', '=', Comment::TYPE_FORUM)
                    ->orderBy('created_at', 'asc')
                    ->with('author')
                    ->paginate($perPage);
    }

    public function getFeaturedForumThreads($count = 3)
    {
        return $this->model->with(['slug', 'tags'])
                   ->where('owner_type', '=', 'GSVnet\Forum\ForumCategory')
                   ->orderBy('created_at', 'desc')
                   ->take($count)
                   ->get();
    }

    public function requireThreadById($id)
    {
        $model = $this->model->where('id', '=', $id)->where('type', '=', COMMENT::TYPE_FORUM)->first();

        if ( ! $model) {
            throw new EntityNotFoundException;
        }

        return $model;
    }
}