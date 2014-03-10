<?php namespace GSVnet\Forum\Threads;

interface ThreadUpdaterListener
{
    public function threadUpdateError($errors);
    public function threadUpdated($thread);
}