{!! Former::open_vertical_for_files()->action(URL::action('MemberController@store'))->id('become-member-form')->novalidate() !!}
    <div class="column-holder" role="main">

        <h2>Wat leuk dat je lid wilt worden van de GSV! Vul het onderstaande formulier in om je in te schrijven.</h2>

        <h3>Let op: je krijgt binnen 15 minuten een bevestigingsmail. Geen mailtje? Neem dan contact op met de PRescie via <a href="mailto:prescie@gmail.com">prescie@gmail.com</a>.</h3>

        <p>
            Wil je eerst nog meer informatie? Neem dan nog een kijkje op <a href="https://www.gsvgroningen.nl">gsvgroningen.nl</a>, bijvoorbeeld het kopje ‘waarom lid worden’ of onze socials! Je kunt ons ook altijd mailen met je vraag naar: prescie@gmail.com Om je inschrijving compleet te maken is het volgen van het novitiaat verplicht. Het novitiaat is een intensieve kennismaking met de GSV van anderhalve week lang. Hierbij ga je eerst een week op kamp waar je kennis kunt maken met de structuur en activiteiten van de GSV. Ook leer je je eigen jaarverband goed kennen. In de halve week daarna maak je kennis met de GSV-leden zelf door allerlei bruisende activiteiten in de stad. Het novitiaat van de GSV heeft een ontgroenend karakter en vindt dit jaar (2023) plaats van 21 augustus t/m 30 augustus. Houd deze dagen dus alvast vrij in je agenda!
        </p>

        @if (count($errors) > 0)
            <div class="error-bar">
                <p><strong>Het formulier is niet helemaal goed ingevuld!</strong></p>
                @foreach($errors->all('<li>:message</li>') as $error)
                    {!! $error !!}
                @endforeach
            </div>
        @endif

        <h2>Jij</h2>

        {{--!! Former::file('photo_path')->label('Upload een foto van jezelf (niet verplicht)')->accept('image') !!--}}

        <div class="form-group {{$errors->has('firstname') || $errors->has('middlename') || $errors->has('lastname') ? ' has-error' : ''}}">
            <label for="firstname" class="control-label">Naam<sup>*</sup></label>
            <input type="text" class="form-control" value="{{old('firstname')}}" placeholder="Voornaam" id="firstname" name="firstname" required>
            <input type="text" class="form-control" value="{{old('middlename')}}" placeholder="Tussenvoegsel" id="middlename" name="middlename" size="4" required>
            <input type="text" class="form-control" value="{{old('lastname')}}" placeholder="Achternaam" id="lastname" name="lastname" required>
        </div>

        {!! Former::select('gender')->label('Geslacht')->options(array('1' => 'Man', '0' => 'Vrouw'))->required() !!}

        <div class="inline-form-row {{$errors->has('birthdate') ? ' has-error' : ''}}">
            <label for="birth-day" class="control-label">Geboortedatum<sup>*</sup></label>
            {!! Former::select('birthDay')->label('')->range(1, 31) !!}
            {!! Former::select('birthMonth')->label('')->options(["01" =>"jan","02" =>"feb","03" =>"mrt","04" =>"apr","05" =>"mei","06" =>"jun","07" =>"jul","08" =>"aug","09" =>"sep","10" =>"okt","11" =>"nov","12" =>"dec"]) !!}
            {!! Former::select('birthYear')->label('')->range(date('Y')-14, 1980) !!}

            {!! $errors->first('birthdate', '<span class="help-block">:message</span>') !!}

        </div>

        {!! Former::text('address')->label('Adres en huisnummer')->placeholder('Straatnaam en nummer')->required() !!}

        <div class="form-group {{$errors->has('zipCode') || $errors->has('town') ? ' has-error' : ''}}">
            <label for="zipCode" class="control-label">Postcode en plaats<sup>*</sup></label>
            <input type="text" class="form-control" value="{{old('zipCode')}}" placeholder="Postcode" id="zipCode" name="zipCode" size="6" required>
            <input type="text" class="form-control" value="{{old('town')}}" placeholder="Woonplaats" id="town" name="town" required>
        </div>

        @if(Auth::check())
            {!! Former::email('email')->label('Email')->placeholder('Email')->required()->value(Auth::user()->email)->disabled() !!}
        @else
            {!! Former::email('email')->label('Email')->placeholder('Email')->required() !!}
        @endif
        {!! Former::text('phone')->label('Telefoon')->placeholder('06-12345678')->required() !!}

        <h2>Studie</h2>
        <p class="side-helper">Als je nog geen studentnummer hebt, hoef je alleen je studie en startjaar in te vullen.</p>
        {!! Former::text('school')->label('Middelbare school')->placeholder('Middelbare school') !!}
        {!! Former::select('studyStartYear')->label('Jaar van inschrijving bij je universiteit of hogeschool')->range(date('Y')+1, date('Y')-5); !!}
        <div class="form-group">
            <label for="study" class="control-label">Studie<sup>*</sup> en studentnummer (alleen als je dat al hebt)</label>
            <input type="text" class="form-control" value="{{old('study')}}" placeholder="Studie" id="study" name="study">
            <input type="text" class="form-control" value="{{old('studentNumber')}}" placeholder="s123456" id="studentNumber" name="studentNumber">
        </div>

        <h2>Account voor GSVnet</h2>
        <p class="side-helper">Met deze gegevens krijg je toegang tot het forum van de GSV. Als lid krijg je volledig toegang tot de website. {{Auth::check() ? 'Omdat je ingelogd bent, kun je deze stap overslaan' : 'Heb je al een account? Vul dan je oude wachtwoord in.'}}</p>

        @if(Auth::check())
        {!! Former::text('username')->label('Gebruikersnaam')->placeholder('Gebruikersnaam')->value(Auth::user()->username)->disabled() !!}
        {!! Former::password('password')->label('Wachtwoord')->placeholder('Wachtwoord')->disabled() !!}
        @else
        {!! Former::text('username')->label('Gebruikersnaam')->placeholder('Gebruikersnaam')->required() !!}
        {!! Former::password('password')->label('Wachtwoord')->placeholder('Wachtwoord')->required() !!}
        {!! Former::password('password_confirmation')->label('Herhaal wachtwoord')->placeholder('Herhaal') !!}
        @endif

        <h2>Gegevens over je ouders</h2>
        <p class="side-helper">Wij zullen deze gegevens alleen gebruiken als het nodig is.</p>
        {!! Former::stacked_radios('parents-same-address')->radios([
            'Ja' => ['name' => 'parents-same-address', 'value' => '1'],
            'Nee' => ['name' => 'parents-same-address', 'value' => '0']
        ])->label('Woon je bij je ouders/verzorgers?')->check('0') !!}

        <div id="parents-info">
            {!! Former::text('parentsAddress')->label('Adres en huisnummer ouders')->placeholder('Straatnaam en nummer') !!}
            <div class="form-group {{$errors->has('parentsZipCode') || $errors->has('parents-town') ? ' has-error' : ''}}">
                <label for="parentsZipCode" class="control-label">Postcode en plaats ouders</label>
                <input type="text" class="form-control" value="{{old('parentsZipCode')}}" placeholder="Postcode" id="parentsZipCode" name="parentsZipCode" size="6">
                <input type="text" class="form-control" value="{{old('parentsTown')}}" placeholder="Woonplaats" id="parentsTown" name="parentsTown">
            </div>
        </div>


        {!! Former::text('parentsPhone')->label('Telefoon ouders')->placeholder('Telefoon ouders')->required() !!}
        {!! Former::text('parentsEmail')->label('Emailadres ouders')->placeholder('Email ouders')->required() !!}

        <h2>Opmerkingen</h2>
        {!! Former::textarea('message')->rows(4)->cols(50)->label('Vragen of opmerkingen?') !!}
        
        <div class="g-recaptcha" data-sitekey="{{ env('G_RECAPTCHA_KEY', 'NO-KEY-FOUND') }}"></div>

    </div>
    <div class="column-holder">
        <div class="control-group">
            <input type="submit" id="submit" value="Meld je aan" class="button">
        </div>
    </div>
{!! Former::close() !!}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>