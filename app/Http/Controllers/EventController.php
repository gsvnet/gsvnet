<?php

use GSVnet\Events\EventsRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class EventController extends BaseController {

    protected $events;

    public function __construct(EventsRepository $events)
    {
        $this->events = $events;
        parent::__construct();
    }

	public function showIndex()
	{
        // Get all events which haven't finishes yet
        $events = $this->events->upcoming(10);
        return view('events.index')
            ->with('searchTimeRange', false)
            ->with('events', $events)
            ->with('types', Config::get('gsvnet.eventTypes'));
    }

    public function showMonth($year, $strMonth = false)
    {
        // Stores the month as number 01 ... 12
        $months = Config::get('gsvnet.months');

        // Create $start and $end variables, which represent the time spans.
        if($strMonth)
        {
            $month = $months[$strMonth];
            $begin = $year . '-' . $month . '-01';
            $end = (new DateTime($year . '-' . $month . '-01'))->format('Y-m-t');
        } else
        {
            $begin = $year . '-01-01';
            $end = $year . '-12-31';
        }

        // Select all events that take place between $start and $end
        $events = $this->events->between($begin, $end);

        // Make the view
        return view('events.index')
            ->with('events', $events)
            ->with('searchTimeRange', true)
            ->with('year', $year)
            ->with('month', $strMonth)
            ->with('types', Config::get('gsvnet.eventTypes'));
    }

    public function showEvent($year, $month, $slug)
    {
        $event = $this->events->bySlug($slug);

        return view('events.show')
            ->with('event', $event)
            ->with('types', Config::get('gsvnet.eventTypes'))
            ->with('year', $year)
            ->with('month', $month)
            ->with('slug', $slug);
    }

    public function participate($year, $month, $slug)
    {
        $event = $this->events->bySlug($slug);
        $user = Auth::user();
        $event->users()->save($user);

        return redirect()->back();
    }

    public function likeReply(LikeReplyValidator $validator, $replyId)
    {
        $data = [
            'userId' => Auth::user()->id,
            'replyId' => $replyId
        ];

        try {
            $validator->validate($data);
        } catch(ValidationException $e) {
            return response()->json($e->getErrors(), 400);
        }

        $this->dispatchFrom(LikeReplyCommand::class, new Collection($data));

        return response()->json();
    }

    //TODO: Potentially obsolete
    public function eventFromDate($year, $month, $slug)
    {
        $date = Carbon::createFromDate($year, Config::get("gsvnet.months.$month"), 1);
        return $this->events->byYearMonthSlug($date, $slug);
    }
}
