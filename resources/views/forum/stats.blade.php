@extends('layouts.default')

@section('title', 'Forumstatistieken')
@section('body-id', 'forum-statistics-page')

@section('javascripts')
    @parent

    @if(!Config::get('app.debug'))
        @include('partials/_analytics')
    @endif

    <script src="//code.highcharts.com/highcharts.js"></script>
    <script src="//code.highcharts.com/modules/data.js"></script>

    <script>
        $(function(){
            $('#likes-given-graph').highcharts({
                title: {
                    text: 'Aantal likes gegeven',
                },
                data: {
                    table: 'likes-given'
                },
                chart: {
                    type: 'column'
                },
                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: 'Likes'
                    }
                }
            });
            $('#likes-received-graph').highcharts({
                title: {
                    text: 'Aantal likes gekregen',
                },
                data: {
                    table: 'likes-received'
                },
                chart: {
                    type: 'column'
                },
                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: 'Likes'
                    }
                }
            });
        });
    </script>
@stop

@section('content')
    <div class="column-holder">
        <h1>Forumstatistieken</h1>
        <p class="delta">Posts en likes per gebruiker en jaarverband</p>
        <section class="main-content forum">
            <h2>Likes</h2>
            <p>All-time statistieken</p>

            <div id="likes-given-graph"></div>
            <div id="likes-received-graph"></div>

            <p>In getallen</p>

            <table id="likes-given" class="table table-bordered table-hover table-condensed">
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

            <table id="likes-received" class="table table-bordered table-hover table-condensed">
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

            <h2 style="margin-top:3em;">Posts</h2>
            <p class="delta">{{$perWeekUsers['from']->formatLocalized('%A %e %B')}} - {{$perWeekUsers['to']->formatLocalized('%A %e %B') }}</p>
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <th width="10%">Nummer</th>
                    <th width="45%">Naam</th>
                    <th width="45%">Posts</th>
                </tr>
                </thead>
                <tbody align="center">
                    @foreach ($perWeekUsers['users'] as $index => $user)
                        @include('forum/_posts_row', ['index' => $index + 1, 'user' => $user])
                    @endforeach
                </tbody>
            </table>

            <h2>Afgelopen maand</h2>
            <p class="delta">{{$perMonthUsers['to']->formatLocalized('%B %Y') }}</p>
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <th width="10%">Nummer</th>
                    <th width="45%">Naam</th>
                    <th width="45%">Posts</th>
                </tr>
                </thead>
                <tbody align="center">
                    @foreach ($perMonthUsers['users'] as $index => $user)
                        @include('forum/_posts_row', ['index' => $index + 1, 'user' => $user])
                    @endforeach
                </tbody>
            </table>

            <h2>Top 250 aller tijden</h2>
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <th width="10%">Nummer</th>
                    <th width="45%">Naam</th>
                    <th width="45%">Posts</th>
                </tr>
                </thead>
                <tbody align="center">
                    @foreach ($allTimeUsers as $index => $user)
                        @include('forum/_posts_row', ['index' => $index + 1, 'user' => $user])
                    @endforeach

                </tbody>
                <tfoot style = 'border-top: 2px solid' align = 'center'>
                    @if ($allTimeUserRank > 250)
                        @include('forum/_posts_row', ['index' => $allTimeUserRank, 'user' => $allTimeUser])
                    @endif
                </tfoot>
            </table>
        </section>
        <div class="secondary-column">
            <h2>Over</h2>
            <p>Deze statistieken worden één keer per dag bijgewerkt.</p>
        </div>
    </div>
@stop