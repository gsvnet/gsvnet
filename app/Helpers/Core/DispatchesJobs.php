<?php namespace App\Helpers\Core;

use ArrayAccess;
use Illuminate\Contracts\Bus\Dispatcher;

trait DispatchesJobs
{
    /**
     * Dispatch a job to its appropriate handler.
     *
     * @param  mixed  $job
     * @return mixed
     */
    protected function dispatch($job)
    {
        return app(Dispatcher::class)->dispatch($job);
    }

    /**
     * Dispatch a command to its appropriate handler in the current process.
     *
     * @param  mixed  $job
     * @return mixed
     */
    public function dispatchNow($job)
    {
        return app(Dispatcher::class)->dispatchNow($job);
    }

    public function dispatchFrom($job, ArrayAccess $source, array $extras = [])
    {
        return app(Dispatcher::class)->dispatchFrom($job, $source, $extras);
    }

    public function dispatchFromArray($job, array $array)
    {
        return app(Dispatcher::class)->dispatchFromArray($job, $array);
    }
}
