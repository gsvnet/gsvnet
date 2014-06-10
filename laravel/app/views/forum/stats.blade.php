@extends('layouts.default')

@section('content')
    <div class="column-holder">
        <h1>Forumstatistieken</h1>
        <p class="delta">Posts per gebruiker</p>
        <section class="main-content forum">
            <h2>Afgelopen week</h2>
            <p class="delta">{{$perWeekUsers['from']->formatLocalized('%A %e %B')}} - {{$perWeekUsers['to']->formatLocalized('%A %e %B') }}</p>
            <ol>
                @foreach ($perWeekUsers['users'] as $user)
                    <li>{{$user->username}}: <strong>{{$user->num}}</strong> <br/> <small>Echte naam {{$user->present()->fullname}}</small></li>
                @endforeach
            </ol>
            
            <h2>Afgelopen maand</h2>
            <p class="delta">{{$perMonthUsers['to']->formatLocalized('%B %Y') }}</p>
            <ol>
                @foreach ($perMonthUsers['users'] as $user)
                    <li>{{$user->username}}: <strong>{{$user->num}}</strong> <br/> <small>Echte naam {{$user->present()->fullname}}</small></li>
                @endforeach
            </ol>

            <h2>De top 250 allertijden</h2>
            <ol>
                @foreach ($allTimeUsers as $user)
                    <li>{{$user->username}}: <strong>{{$user->num}}</strong> <br/> <small>Echte naam {{$user->present()->fullname}}</small></li>
                @endforeach
            </ol>
        </section>
        <div class="secondary-column">
            <h2>Let op!</h2>
            <p>Ik weet nog niet helemaal zeker of de statistieken gelijk up-to-date zijn. Het duurt maximaal 24h tot ze opnieuw berekend worden.</p>
        </div>
    </div>
@stop