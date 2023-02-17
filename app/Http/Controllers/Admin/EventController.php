<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Events\EventsRepository;
use App\Helpers\Events\EventValidator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class EventController extends AdminBaseController
{
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

    public function index(): View
    {
        $events = $this->events->paginate(50, false);

        return view('admin.events.index')
            ->with('events', $events);
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(): RedirectResponse
    {
        $input = Request::all();
        $input['location'] = Request::get('location', '');
        $input['whole_day'] = Request::get('whole_day', false);
        $input['public'] = Request::get('public', false) == 1;
        $input['published'] = Request::get('published', false) == 1;

        $this->validator->validate($input);
        $event = $this->events->create($input);

        flash()->success("{$event->title} is succesvol opgeslagen.");

        return redirect()->action([\App\Http\Controllers\Admin\EventController::class, 'index']);
    }

    public function show($id): View
    {
        $event = $this->events->byId($id);

        return view('admin.events.show')
            ->with('event', $event);
    }

    public function edit($id): View
    {
        $event = $this->events->byId($id);

        return view('admin.events.edit')
            ->with('event', $event);
    }

    public function update($id): RedirectResponse
    {
        $input = Request::all();
        $input['location'] = Request::get('location', '');
        $input['whole_day'] = Request::get('whole_day', '0');
        $input['public'] = Request::get('public', false) == 1;
        $input['published'] = Request::get('published', false) == 1;

        $this->validator->validate($input);
        $event = $this->events->update($id, $input);

        flash()->success("{$event->title} is succesvol bewerkt.");

        return redirect()->action([\App\Http\Controllers\Admin\EventController::class, 'index']);
    }

    public function destroy($id): RedirectResponse
    {
        $event = $this->events->delete($id);

        flash()->success("{$event->title} is succesvol verwijderd.");

        return redirect()->action([\App\Http\Controllers\Admin\EventController::class, 'index']);
    }
}
