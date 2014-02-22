<?php namespace GSVnet\Events;

use Permission;

class EventsRepository {
    public function byId($id)
    {
        return Event::findOrFail($id);
    }

    public function paginate($amount = 5, $published = true)
    {
        if (Permission::has('events.show-private'))
        {
            return Event::published($published)->paginate($amount);
        }
        return Event::published($published)->public()->paginate($amount);
    }

    public function upcoming($amount = 5, $published = true)
    {
        $events = Event::where('end_date', '>=', new \DateTime('now'))
            ->orderBy('start_date', 'asc')
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
            ->orderBy('start_date', 'asc')
            ->where('end_date', '>=', $start)
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
        $event              = $this->byId($id);
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
    * @TODO: delete all photos
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
        $event->title       = $properties['title'];
        $event->description = $properties['description'];
        $event->location    = $properties['location'];
        $event->start_date  = $properties['start_date'];
        $event->end_date    = $properties['end_date'];
        $event->whole_day   = $properties['whole_day'];

        // Check if whole day is NOT checked
        if ($properties['whole_day'] == '0')
        {
            $event->start_time  = $properties['start_time'];
            $event->end_time    = $properties['end_time'];
        }

        return $event;
    }
}