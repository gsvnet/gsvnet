<?php namespace GSV\Providers;

use GSV\Handlers\Events\ThreadEventHandler;
use GSV\Handlers\Events\UserEventHandler;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $subscribe = [
        ThreadEventHandler::class,
        UserEventHandler::class
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }
}
