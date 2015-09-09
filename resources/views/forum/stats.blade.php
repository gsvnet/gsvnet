@extends('layouts.default')

@section('body-id', 'forum-statistics-page')

@section('content')
    <div class="column-holder">
        <h1>Forumstatistieken</h1>
        <p class="delta">Posts en likes per gebruiker en jaarverband</p>
        <section class="main-content forum">
            <h2>Likes per jaarverband</h2>
            <p>All-time statistieken</p>

            <table class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr>
                        <th width="50%">Jaarverband</th>
                        <th width="50%"># likes uitgedeeld</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @foreach($likesGiven as $yeargroup)
                    <tr>
                        <td>{{ $yeargroup->name }}</td>
                        <td>{{ $yeargroup->likes_given }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <th width="50%">Jaarverband</th>
                    <th width="50%"># likes gekregen</th>
                </tr>
                </thead>
                <tbody align="center">
                    @foreach($likesReceived as $yeargroup)
                        <tr>
                            <td>{{ $yeargroup->name }}</td>
                            <td>{{ $yeargroup->likes_received }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h2 style="margin-top:3em;">Afgelopen week</h2>
            <p class="delta">{{$perWeekUsers['from']->formatLocalized('%A %e %B')}} - {{$perWeekUsers['to']->formatLocalized('%A %e %B') }}</p>
            <ol>
                @foreach ($perWeekUsers['users'] as $user)
                    <li>
                        <a href="{{URL::action('UserController@showUser', ['id' => $user->id])}}">
                            {{{$user->present()->fullname}}} ({{{$user->username}}}): <strong>{{$user->num}}</strong>
                        </a>
                    </li>
                @endforeach
            </ol>
            
            <h2>Afgelopen maand</h2>
            <p class="delta">{{$perMonthUsers['to']->formatLocalized('%B %Y') }}</p>
            <ol>
                @foreach ($perMonthUsers['users'] as $user)
                    <li>
                        <a href="{{URL::action('UserController@showUser', ['id' => $user->id])}}">
                            {{{$user->present()->fullname}}} ({{{$user->username}}}): <strong>{{$user->num}}</strong>
                        </a>
                    </li>
                @endforeach
            </ol>

            <h2>De top 250 allertijden</h2>
            <ol>
                @foreach ($allTimeUsers as $user)
                    <li>
                        <a href="{{URL::action('UserController@showUser', ['id' => $user->id])}}">
                            {{{$user->present()->fullname}}} ({{{$user->username}}}): <strong>{{$user->num}}</strong>
                        </a>
                    </li>
                @endforeach
            </ol>
        </section>
        <div class="secondary-column">
            <h2>Let op!</h2>
            <p>Ik weet nog niet helemaal zeker of de statistieken gelijk up-to-date zijn. Het duurt maximaal 24h tot ze opnieuw berekend worden.</p>
        </div>
    </div>
@stop