<?php namespace GSVnet\Forum\Replies;

interface ReplyCreatorListener
{
    public function replyCreationError($errors);
    public function replyCreated($reply);
}