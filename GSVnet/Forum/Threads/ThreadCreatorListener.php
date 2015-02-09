<?php namespace GSVnet\Forum\Threads;

interface ThreadCreatorListener
{
    public function threadCreationError($errors);
    public function threadCreated($thread);
}