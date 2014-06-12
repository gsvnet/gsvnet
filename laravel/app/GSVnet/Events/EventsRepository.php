<?php namespace GSVnet\Events;

use Permission;
use GSVnet\Permissions\NoPermissionException;
use Carbon\Carbon;

class EventsRepository {
    public function byId($id)
    {
        $event = Event::findOrFail($id);

        if (! $event->public and ! Permission::has('events.show-private'))
        {
            throw new NoPermissionException;
        }

        if (! $event->published and ! Permission::has('events.publish'))
        {
            throw new NoPermissionException;
        }

        return $event;
    }

    public function bySlug($slug)
    {
        $event = Event::where('slug', '=', $slug)->first();

        if( ! $event )
        {
            \App::abort(404);
        }

        if (! $event->public and ! Permission::has('events.show-private'))
        {
            throw new NoPermissionException;
        }

        if (! $event->published and ! Permission::has('events.publish'))
        {
            throw new NoPermissionException;
        }

        return $event;
    }

    public function byYearMonthSlug(Carbon $date, $slug)
    {
        $start = $date->format('Y-m-01');
        $end = $date->format('Y-m-t');

        $event = Event::where('slug', '=', $slug)
                    ->where('start_date', '<=', $end)
                    ->where('start_date', '>=', $start)
                    ->first();

        if( ! $event )
        {
            \App::abort(404);
        }

        if (! $event->public and ! Permission::has('events.show-private'))
        {
            throw new NoPermissionException;
        }

        if (! $event->published and ! Permission::has('events.publish'))
        {
            throw new NoPermissionException;
        }

        return $event;
    }

    public function paginate($amount = 5, $published = true)
    {
        if (Permission::has('events.show-private'))
        {
            return Event::published($published)->orderBy('start_date', 'desc')->orderBy('start_time', 'desc')->paginate($amount);
        }
        return Event::published($published)->public()->orderBy('start_date', 'desc')->orderBy('start_time', 'desc')->paginate($amount);
    }

    public function upcoming($amount = 5, $published = true)
    {
        $events = Event::where('end_date', '>=', date('Y-m-d'))
            ->orderBy('start_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->published($published);

        if (! Permission::has('events.show-private'))
        {
            $events = $events->public();
        }

        return $events->paginate($amount);
    }

    public function between($start, $end, $amount = 5, $published = true)
    {
        $events = Event::where('start_date', '<=', $end)
            ->where('end_date', '>=', $start)
            ->orderBy('start_date', 'asc')
            ->orderBy('start_time', 'asc')
            ->published($published);

        if (! Permission::has('events.show-private'))
        {
            $events = $events->public();
        }

        return $events->paginate($amount);
    }

    /**
    * Create event
    *
    * @param array $input
    * @return Event
    */
    public function create(array $input)
    {
        $event = new Event();
        $event = $this->setEventProperties($event, $input);
        $event->save();

        return $event;
    }

    /**
    * Update event
    *
    * @param int $id
    * @param array $input
    * @return Event
    */
    public function update($id, array $input)
    {
        $event = $this->byId($id);
        $event = $this->setEventProperties($event, $input);
        $event->save();

        return $event;
    }

    /**
    * Delete event
    *
    * @param int $id
    * @param array $input
    * @return Event
    */
    public function delete($id)
    {
        $event = $this->byId($id);
        $event->delete();

        return $event;
    }

    private function setEventProperties($event, $properties)
    {
        // Set properties
        $event->title            = $properties['title'];
        $event->meta_description = $properties['meta_description'];
        $event->description      = $properties['description'];
        $event->location         = $properties['location'];
        $event->type             = $properties['type'];
        $event->start_date       = $properties['start_date'];
        $event->end_date         = $properties['end_date'];
        $event->whole_day        = $properties['whole_day'];
        $event->public           = $properties['public'];

        if (Permission::has('events.publish'))
        {
            $event->published = $properties['published'];
        }

        // Check if whole day is NOT checked
        if ($properties['whole_day'] == '0')
        {
            $event->start_time  = $properties['start_time'];
        }

        // Slug
        $event->slug = $event->generateNewSlug();

        return $event;
    }
}