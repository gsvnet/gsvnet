@extends('layouts.default')

@section('title', $event->title . ' - activiteiten')
@section('title', $event->meta_description)
@section('body-id', 'single-event-page')

@section('content')
    <div class="column-holder" role="main" itemscope itemtype="http://data-vocabulary.org/Event">

        <h1>{{{ $event->title }}}</h1>
        <div class="main-content">
            <meta itemprop="summary" content="{{{$event->meta_description}}}">
            <ul class="inline-list delta">
                <li>{{{ $event->present()->from_to_long() }}}
                    <time itemprop="startDate" datetime="{{{ $event->present()->startDateISO8601 }}}"></time>
                    <time itemprop="endDate" datetime="{{{ $event->present()->endDateISO8601 }}}"></time>
                </li> 
                @if( !empty($event->location) )
                    <li itemprop="location">{{{ $event->location }}}</li>
                @endif
            </ul>
            <div itemprop="description">
                {!! $event->present()->descriptionFormatted !!}
            </div>

            @can('events.show-private')
                <div style="margin-top:3em">
                    <form method="post" action="{{URL::action('EventController@participate', array('year'=>$year, 'month'=>$month, 'slug'=>$slug))}}">
                        <input type="submit" id="submit-reply" value="Ben ik bij" class="button float-right">
                    </form>
                    {{--  {!! Former::open()->action(action('EventController@participate', array('year'=>$year, 'month'=>$month, 'slug'=>$slug)))->method('post') !!}
                    {!! Former::text('query')->placeholder('Zoeken op het forum')->label(false) !!}
                    {!! Former::actions( Button::submit('Submit') ) !!}
                    {!! Former::close() !!}  --}}
                    {{--  <a style="float:right" class="button" href="{{URL::action('EventController@participate', array('year'=>$year, 'month'=>$month, 'slug'=>$slug))}}" rel="nofollow">Ben ik bij</a>                          --}}
                    <h3>Deelnemers:</h3>
                    @if(count($event->users) > 0)
                    <ol>
                        @foreach($event->users as $user)
                            <li>{{$user->firstname}} {{$user->lastname}}</li>
                        @endforeach
                    </ol>
                    @else
                        <p>Nog geen deelnemers</p>
                    @endif
                </div>
            @endcan
        </div>

        <div class="secondary-column">
            @if (! $event->public)
                <h2>Privé</h2>
                <p>Deze activiteit is alleen zichtbaar voor GSV'ers</p>
            @endif
            <div class="icon-scale{{{$types[$event->type] ? ' i-' . $types[$event->type] : ''}}}"></div>
        </div>
    </div>
@stop