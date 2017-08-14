@extends('layouts.default')

@section('title', 'Word lid bij de GSV Groningen')
@section('description', 'Wil jij een fantastische studententijd? Meld je dan aan bij de GSV Groningen')
@section('body-id', 'become-member-index-page')

@section('content')
    <div class="column-holder" role="main">
        <p class="delta">
            Wil jij een onvergetelijke studententijd?
        </p>
        <div class="main-content">
            <p>De GSV is de meest hechte christelijke studentenvereniging van Groningen. Onze vereniging biedt de perfecte combinatie van christelijke waarden en het echte studentenleven.</p>
            <p>Door onze lange historie heen hebben wij keer op keer bewezen de beste match te zijn tussen het échte studentenleven en het christelijk geloof.</p>

            <h2>Wat is de GSV?</h2>
            <p>
                <iframe frameborder="0" width="560" height="315" src="//www.dailymotion.com/embed/video/x5wxp95" allowfullscreen></iframe>
                <br />
                <a href="http://www.dailymotion.com/video/x5wxp95" target="_blank">Dit is de GSV</a> <i>door  <a href="http://www.dailymotion.com/degsv" target="_blank">degsv</a></i>
            </p>
        </div>
        <div class="secondary-column">
            <h2>Gelijk inschrijven</h2>
            <p><a href="{{ URL::action('MemberController@becomeMember') }}" class="button" title="Meld je aan">Meld je aan!</a></p>

            <h2>Vragen?</h2>
            <p>Kijk op de <a href="{{ URL::action('MemberController@faq') }}" title="Veel gestelde vragen">FAQ-pagina</a></p>
        </div>
    </div>
@stop