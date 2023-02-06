<?php namespace Admin;

use View, Input, Redirect;

use App\Helpers\Events\EventsRepository;
use App\Helpers\Events\EventValidator;

class EventController extends AdminBaseController {

    protected $events;
    protected $validator;

    public function __construct(
        EventsRepository $events,
        EventValidator $validator)
    {
        $this->events = $events;
        $this->validator = $validator;

        $this->authorize('events.manage');
        parent::__construct();
    }

    public function index()
    {
        $events = $this->events->paginate(50, false);

        return view('admin.events.index')
            ->withEvents($events);
    }

    public function create()
    {
        return view('admin.events.create');
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

        flash()->success("{$event->title} is succesvol opgeslagen.");

        return redirect()->action('Admin\EventController@index');
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

        flash()->success("{$event->title} is succesvol bewerkt.");

        return redirect()->action('Admin\EventController@index');
    }

    public function destroy($id)
    {
        $event = $this->events->delete($id);

        flash()->success("{$event->title} is succesvol verwijderd.");

        return redirect()->action('Admin\EventController@index');
    }

}