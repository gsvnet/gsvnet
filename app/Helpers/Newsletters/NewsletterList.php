<?php namespace App\Helpers\Newsletters;


interface NewsletterList {
    /**
     * @param $listName
     * @param $email
     * @param $variables
     * @return mixed
     */
    public function subscribeTo($listName, $email, $variables);

    /**
     * @param $list
     * @param $email
     * @return mixed
     */
    public function unsubscribeFrom($list, $email);

    /**
     * @param $listname
     * @param $batch
     * @return mixed
     */
    public function batchSubscribeTo($listname, $batch);

    /**
     * @param $listname
     * @param $batch
     * @return mixed
     */
    public function batchUnsubscribeFrom($listname, $batch);
} 