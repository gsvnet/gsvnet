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
                <iframe src="https://prezi.com/embed/b6j6hhz8z9bl/?bgcolor=ffffff&amp;lock_to_path=0&amp;autoplay=0&amp;autohide_ctrls=0&amp;landing_data=bHVZZmNaNDBIWnNjdEVENDRhZDFNZGNIUE1lNjhCRUpSbVVNaldpOExIVmtlRFlVaEdHeWNYblFhYStBRVpzb2IyST0&amp;landing_sign=CZ6SiEAGtW_r5ftf5uHZ1Mc6yMErDchAiwcHXeLT2pM" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" id="iframe_container" frameborder="0" height="600" width="560"></iframe>
            </p>

            <h2>KEI-week 2015 aftermovie</h2>
            <p>Bekijk hieronder de aftermovie van de afgelopen keiweeek.</p>
            <p>
                <iframe frameborder="0" width="560" height="315" src="//www.dailymotion.com/embed/video/x3egf0x" allowfullscreen></iframe>
                <br />
                <a href="http://www.dailymotion.com/video/x3egf0x_kei-week-gsv-atv-aftermovie_webcam" target="_blank">KEI-week GSV/ATV Aftermovie</a>
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