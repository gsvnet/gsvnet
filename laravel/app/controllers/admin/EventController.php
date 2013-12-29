<?php namespace Admin;

use View;
use Model\Event;
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
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d'
        ];

        // Validate photo name, album id and file type
        $validation = Validator::make($input, $rules);
        
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
    }

    public function update($id)
    {

    }

    public function destroy($id)
    {
    }

}