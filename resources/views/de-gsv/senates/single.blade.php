@extends('layouts.default')

@section('title', 'Senaat ' . $currentSenate->name)
@section('description', 'Senaat ' . $currentSenate->name)
@section('body-id', 'senate-page')

@section('content')

    <div class="column-holder">
        <h1>{{{$currentSenate->present()->nameWithYear}}}</h1>
        <div class="main-content has-border-bottom" role="main">
            {!! $currentSenate->present()->bodyFormatted !!}
        </div>

        <div class="secondary-column">
            @if ($currentSenate->present()->canPresent())
            <div class="content-columns content-column">
                <h2>Leden</h2>
                <ul class="unstyled-list title-description-list">
                    @foreach($members as $member)
                    <li>
                        @can('users.show')
                            <a href="{{URL::action([\App\Http\Controllers\UserController::class, 'showUser'], [$member->id])}}" title="Bekijk het profiel van {{{$member->present()->fullName}}}" class="list-title">{{{$member->present()->fullName}}}</a>
                        @else
                            <span class="list-title">{{{$member->present()->fullName}}}</span>
                        @endcan
                        <span class="list-description grey">{{{$member->present()->senateFunction}}}</span>
                    </li>
                    @endforeach
                </ul>

            </div>
            @endif
            <div class="content-columns content-column">
                @include('de-gsv.senates._list')
            </div>
        </div>
    </div>
@stop