@extends('emails.layout')

@section('header')
    Profielwijziging
@stop

@section('content')
    <h2>Profiel {{{ $fullname }}}</h2>
    <p>Beste abactis, bovenstaande persoon heeft zijn profiel gewijzigd. Hieronder staat welke velden veranderd zijn.</p>

    <h3>Email en gebruikersnaam</h3>
    <ul>
        {{-- Loop over all data --}}
        @foreach($userFields as $key => $nicename)
            @if($oldUser[$key] != $newUser[$key])
                <li>{{{$nicename}}}: van {{{$oldUser[$key]}}} naar <strong>{{{$newUser[$key]}}}</strong></li>
            @endif
        @endforeach
    </ul>

    <h3>GSV-profieldata</h3>
    <ul>
        {{-- Loop over all data --}}
        @foreach($profileFields as $key => $nicename)
            @if($oldProfile[$key] != $newProfile[$key])
                <li>{{{$nicename}}}: van {{{$oldProfile[$key]}}} naar <strong>{{{$newProfile[$key]}}}</strong></li>
            @endif
        @endforeach
    </ul>

    <p>Liefs, de webcie.</p>
@stop