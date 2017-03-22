@extends('layouts.default')

@section('title', 'De GSV')
@section('description', 'De GSV is een christelijke studentenvereniging met een gereformeerde basis. Ze heeft zo\'n 200 leden die wekelijks bijeen komen voor bijbelstudie een biertje op soos.')
@section('body-id', 'about-page')

@section('content')
    <div class="column-holder" role="main">
        <div class="main-content has-border-bottom">

            <h2>April Fools</h2>
            
            <br /><br />            
            <h3>Huidige identiteitsveranderingen</h3>
            <table>
                <th style="text-align: left">Oude identiteit</th><th style="text-align: left">Nieuwe identiteit</th>
                @foreach($victims as $index => $victim)
                    <tr>
                        <td>{{ $index + 1 }}. {{ $victim->firstname }} {{ $victim->lastname }}</td>
                        <td>{{ $victim->identity->firstname }} {{ $victim->identity->lastname }}</td>
                    </tr>
                @endforeach
            </table>

            <br /><br />
            <h3>Meest actief vandaag</h3>
            <table>
                @foreach($activeUsers as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}. {{ $user->firstname }} {{ $user->lastname }} ({{$user->num}} posts)</td>
                    </tr>
                @endforeach
            </table>

        </div>
        @if($canModify)
            <div class="secondary-column">
                <div class="content-columns">
                    <div class="content-column">
                        <h2>Doe dingen</h2>
                        <p>
                            <a href="{{ URL::action('AprilFoolsController@addActiveToTable') }}" class="button">10 actiefste mensen van vandaag toevoegen</a>
                            <i>Zoek in 10 actiefste mensen naar mensen die nog niet zijn toegevoegd.</i>
                        </p>
                        <p>
                            <a href="{{ URL::action('AprilFoolsController@resetTable') }}" class="button">Alles opnieuw indelen</a>
                            <i>Opmerking: Vanaf 1 april niet meer gebruiken, valt te veel op.</i>
                        </p>
                        
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop