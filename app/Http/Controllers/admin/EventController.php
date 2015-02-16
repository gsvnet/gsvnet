<?php namespace Admin;

use View, Input, Redirect;

use GSVnet\Events\EventsRepository;
use GSVnet\Events\EventValidator;

class EventController extends AdminBaseController {

    protected $events;
    protected $validator;

    public function __construct(
        EventsRepository $events,
        EventValidator $validator)
    {
        $this->events = $events;
        $this->validator = $validator;

        $this->beforeFilter('has:events.manage');
        parent::__construct();
    }

    public function index()
    {
        $events = $this->events->paginate(50, false);

        return view('admin.events.index')
            ->withEvents($events);
    }

    public function store()
    {
        $input = Input::all();
        $input['location'] = Input::get('location', '');
        $input['whole_day'] = Input::get('whole_day', false);
        $input['public'] = Input::get('public', false) == 1;
        $input['published'] = Input::get('published', false) == 1;

        $this->validator->validate($input);
        $event = $this->events->create($input);

        $message = '<strong>' . $event->title . '</strong> is succesvol opgeslagen.';
        return redirect()->action('Admin\EventController@index')
            ->withMessage($message);
    }

    public function show($id)
    {
        $event = $this->events->byId($id);

        return view('admin.events.show')
            ->withEvent($event);
    }

    public function edit($id)
    {
        $event = $this->events->byId($id);

        return view('admin.events.edit')
            ->withEvent($event);
    }

    public function update($id)
    {
        $input = Input::all();
        $input['location'] = Input::get('location', '');
        $input['whole_day'] = Input::get('whole_day', '0');
        $input['public'] = Input::get('public', false) == 1;
        $input['published'] = Input::get('published', false) == 1;

        $this->validator->validate($input);
        $event = $this->events->update($id, $input);

        $message = '<strong>' . $event->title . '</strong> is succesvol bewerkt.';
        return redirect()->action('Admin\EventController@index')
            ->withMessage($message);

    }

    public function destroy($id)
    {
        $event = $this->events->delete($id);

        return redirect()->action('Admin\EventController@index')
            ->with('message', '<strong>' . $event->title . '</strong> is succesvol verwijderd.');
    }

}