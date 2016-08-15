@extends('layouts.default')

@section('title', 'Contact')
@section('description', 'Op deze pagina kunt u de contactgegevens van het abactiaat en het sociëteitspand van de GSV vinden')
@section('body-id', 'contact-page')

@section('content')
    <div class="column-holder" role="main">
        <h1>Contact</h1>

        <div class="main-content">
			<div class="content-columns">
				<div class="content-column">
					<address>
						<h3>Abactiaat</h3>
						Postbus 1030<br/>
						9701 BA Groningen<br/>
						{!!HTML::mailto('abactis@gsvnet.nl')!!}
					</address>
					
				</div>
				<div class="content-column">
					<address>
						<h3>Sociëteit</h3>
						Hereweg 40<br/>
						Postbus 7005<br/>
						9701 JA Groningen<br/>
						{!!HTML::mailto('voorzitter@vgse.nl')!!}
					</address>
				</div>
			</div>

			<div class="content-columns">
				<div class="content-column">
					<h3>Senaat</h3>
					<ul class="unstyled-list title-description-list">
						<li>
							<span class="list-title">Senaat der GSV</span>
							<span class="list-description">{!!HTML::mailto('senaat@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Praeses</span>
							<span class="list-description">{!!HTML::mailto('praeses@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Assessor primus</span>
							<span class="list-description">{!!HTML::mailto('assessorprimus@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Fiscus</span>
							<span class="list-description">{!!HTML::mailto('fiscus@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Abactis</span>
							<span class="list-description">{!!HTML::mailto('abactis@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Assessor secundus</span>
							<span class="list-description">{!!HTML::mailto('assessorsecundus@gsvnet.nl')!!}</span>
						</li>
					</ul>
					<h3>Partners</h3>
					<ul class="unstyled-list title-description-list">
						<li>
							<span class="list-title">IFES-medewerker</span>
							<address>
								Frederik Boersema<br />
								tel. 06-49942102
							</address>
							<span class="list-description">{!! HTML::link('https://www.ifes.nl') !!}</span>
						</li>
						<li>
							<span class="list-title">Student Coaching</span>
							Wakker bij Bakker<br />
							<span class="list-description">{!! HTML::link('http://www.wakkerbijbakker.nl') !!}</span>
						</li>
					</ul>
				</div>
				<div class="content-column">
					<h3>Commissies</h3>
					<ul class="unstyled-list title-description-list">
						<li>
							<span class="list-title">Introductieperiode (Novcie)</span>
							<span class="list-description">{!!HTML::mailto('novcie@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Promotiecommissie (PRescie)</span>
							<span class="list-description">{!!HTML::mailto('prescie@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Webbeheerder (Webcie)</span>
							<span class="list-description">{!!HTML::mailto('webcie@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Amicale banden (ABC)</span>
							<span class="list-description">{!!HTML::mailto('abc@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Lezingen en debatten (OVcie)</span>
							<span class="list-description">{!!HTML::mailto('ovcie@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Verenigingsblad (SIC-redactie)</span>
							<span class="list-description">{!!HTML::mailto('sicredactie@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Acquisities (Commercie)</span>
							<span class="list-description">{!!HTML::mailto('commercie@gsvnet.nl')!!}</span>
						</li>
						<li>
							<span class="list-title">Dies Natalis (Diescie)</span>
							<span class="list-description">{!!HTML::mailto('diescie@gsvnet.nl')!!}</span>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="secondary-column">

			<h2>Adverteren</h2>
			<p>Het is mogelijk voor bedrijven en andere commerciële instellingen om te adverteren op onze site. Aan het adverteren op deze website zijn bepaalde voorwaarden verbonden. Wilt u graag een advertentie plaatsen?  Informeer naar de mogelijkheden door naar onderstaand adres te mailen: {!!HTML::mailto('commercie@gsvnet.nl')!!}</p>
		</div>
    </div>
    
    <div class="maps-1600x540">
    	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9557.74407821405!2d6.57623206715855!3d53.21003010224121!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c832aab5b8d675%3A0xff64bbce520f0fc5!2sHereweg+40A!5e0!3m2!1snl!2snl!4v1395009442604" width="1600" height="540" frameborder="0" style="border:0"></iframe>
    </div>

@stop

@section('word-lid')

@stop