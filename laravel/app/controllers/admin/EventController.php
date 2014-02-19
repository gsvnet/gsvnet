<?php namespace Admin;

use View;
use GSVnet\Events\Event;
use Input;
use Validator;
use Str;
use Redirect;
use File;

class EventController extends BaseController {
    public function __construct()
    {
        $this->beforeFilter('csrf', ['only' => array('store', 'update', 'delete')]);
        parent::__construct();
    }

    public function index()
    {
        $events = Event::paginate(10);

        $this->layout->content = View::make('admin.events.index')
            ->with('events', $events);
    }

    public function store()
    {
        $input = Input::all();

        // Validate photo name, album id and file type
        $validation = Validator::make($input, Event::$rules);

        // Require time only if it is not a whole day
        $validation->sometimes(array('start_time', 'end_time'), 'required', function($input){
            return $input->get('whole_day', '0') == '0';
        });

        if ($validation->passes())
        {
            $event = new Event();

            $event->title = $input['title'];
            $event->description = $input['description'];
            $event->location = Input::get('description', '');
            $event->start_date = $input['start_date'];
            $event->end_date = $input['end_date'];
            $event->whole_day = Input::get('whole_day', '0');

            // Check if whole day is NOT checked
            if (Input::get('whole_day', '0') == '0')
            {
                $event->start_time = $input['start_time'];
                $event->end_time = $input['end_time'];
            }

            $event->save();

            return Redirect::action('Admin\EventController@index')
                ->with('message', '<strong>' . $event->title . '</strong> is succesvol opgeslagen.')
                ->with('changedID', $event->id);
        }

        return Redirect::back()->withInput()->withErrors($validation);
    }

    public function show($id)
    {
        $event = Event::find($id);

        $this->layout->content = View::make('admin.events.show')->withEvent($event);
    }

    public function edit($id)
    {
        $event = Event::find($id);

        $this->layout->content = View::make('admin.events.edit')
            ->withEvent($event);
    }

    public function update($id)
    {
        $input = Input::all();
        $event = Event::findOrFail($id);

        $validation = Validator::make($input, Event::$rules);

        // Require time only if it is not a whole day
        $validation->sometimes(array('start_time', 'end_time'), 'required', function($input){
            return $input->get('whole_day', '0') == '0';
        });

        if ($validation->passes())
        {

            $event->title = $input['title'];
            $event->description = $input['description'];
            $event->location = Input::get('description', '');
            $event->start_date = $input['start_date'];
            $event->end_date = $input['end_date'];
            $event->whole_day = Input::get('whole_day', '0');

            // Check if whole day is NOT checked
            if (Input::get('whole_day', '0') == '0')
            {
                $event->start_time = $input['start_time'];
                $event->end_time = $input['end_time'];
            }

            $event->save();

            return Redirect::action('Admin\EventController@index')
                ->with('message', '<strong>' . $event->title . '</strong> is succesvol bewerkt.')
                ->with('changedID', $event->id);
        }

        return Redirect::back()->withInput()->withErrors($validation);

    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        $event->delete();
    }

}