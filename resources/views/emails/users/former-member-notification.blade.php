@extends('emails.layout')

@section('header')
    Welkom op GSVnet
@stop

@section('content')
    <h2 style="font-size:36px;font-family:'PT Sans', Corbel, 'Helvetica Neue', Arial, sans-serif;margin-bottom:15px;line-height:36px;">
        Beste {{{ $user->present()->fullName }}},
    </h2>
    <p style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">
        U ontvangt deze email omdat de GSV bezig is oud-leden weer bij elkaar te brengen, met het oog op het
        <strong>tiende lustrum</strong> in 2016.
    </p>

    <h2 style="font-size:36px;font-family:'PT Sans', Corbel, 'Helvetica Neue', Arial, sans-serif;margin-bottom:15px;line-height:36px;">
        Wat u kunt verwachten
    </h2>
    <p style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">
        Binnen enkele maanden kunt u gegevens van oud-leden terug vinden op de website van het MAL-fonds (http://malfonds.nl). Daarnaast
        maken we een online forum waar u leden uit uw tijd kunt spreken.
    </p>

    <h2 style="font-size:36px;font-family:'PT Sans', Corbel, 'Helvetica Neue', Arial, sans-serif;margin-bottom:15px;line-height:36px;">
        Wat u nu kunt doen
    </h2>
    <p style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">
        Om dit tot een succes te maken, stellen wij het op prijs dat u uw persoonlijke gegevens controleert.
        Dit gaat als volgt:
    </p>

    <ol style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">
        <li style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">Er is een account voor u gemaakt op http://gsvnet.nl</li>
        <li style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">Vraag een wachtwoord op via http://gsvnet.nl/wachtwoord-vergeten/herinner</li>
        <li style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">Log in op GSVnet</li>
        <li style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">Daar ziet u de gegevens die wij van u hebben</li>
        <li style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">U kunt zelf uw gegevens bijwerken!</li>
    </ol>

    <p style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">
        Hartelijk dank alvast!
    </p>
    <p style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;">
        De Malversacie
    </p>

    <br/><br/>

    <p style="font-family:'PT Serif', Georgia, 'Times New Roman', Times, serif;font-size:18px;line-height:30px;color:#AAA;">Vragen? Stuur een mailtje terug!</p>
@stop