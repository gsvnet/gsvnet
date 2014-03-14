<?php namespace GSVnet\Forum\Replies;

interface ReplyDeleterListener
{
    public function replyDeleted($thread);
}