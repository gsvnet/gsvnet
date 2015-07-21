{!! Former::open_vertical_for_files()->action(URL::action('MemberController@store'))->id('become-member-form') !!}

    <div class="column-holder" role="main">

        @foreach($errors->all() as $error))
            {!! $error !!}
        @endforeach

        <h2>Jij</h2>

        <div class="preview-image-wrap">
            <div id="preview-image"></div>
        </div>

        {!! Former::file('photo_path')->label('Upload een foto van jezelf')->accept('image') !!}

        <div class="form-group">
            <label for="firstname" class="control-label">Naam<sup>*</sup></label>
            <input type="text" class="form-control" value="{{old('firstname')}}" placeholder="Voornaam" id="firstname" name="firstname" required>
            <input type="text" class="form-control" value="{{old('middlename')}}" placeholder="Tussenvoegsel" id="middlename" name="middlename" size="4" required>
            <input type="text" class="form-control" value="{{old('lastname')}}" placeholder="Achternaam" id="lastname" name="lastname" required>
        </div>

        {!! Former::select('gender')->label('Geslacht')->options(array('1' => 'Man', '0' => 'Vrouw'))->required() !!}

        <div class="inline-form-row {{$errors->has('birthdate') ? ' has-error' : ''}}">
            <label for="birth-day" class="control-label">Geboortedatum<sup>*</sup></label>
            {!! Former::select('birth-day')->label('')->range(1, 31) !!}
            {!! Former::select('birth-month')->label('')->options(["01" =>"jan","02" =>"feb","03" =>"mrt","04" =>"apr","05" =>"mei","06" =>"jun","07" =>"jul","08" =>"aug","09" =>"sep","10" =>"okt","11" =>"nov","12" =>"dec"]) !!}
            {!! Former::select('birth-year')->label('')->range(date('Y')-14, 1980) !!}

            {!! $errors->first('birthdate', '<span class="help-block">:message</span>') !!}

        </div>

        {!! Former::text('address')->label('Adres en huisnummer')->required() !!}

        <div class="form-group">
            <label for="zip-code" class="control-label">Postcode en plaats</label>
            <input type="text" class="form-control" value="{{old('zip-code')}}" placeholder="Postcode" id="zip-code" name="zip-code" size="6" required>
            <input type="text" class="form-control" value="{{old('town')}}" placeholder="Woonplaats" id="town" name="town" required>
        </div>

        {!! Former::email('email')->label('Email')->placeholder('Email')->required() !!}
        {!! Former::text('phone')->label('Telefoon')->placeholder('06-12345678')->required() !!}

        <h2>Studie</h2>
        <p class="side-helper">Als je nog geen studentnummer hebt, hoef je alleen je studie en startjaar in te vullen.</p>
        {!! Former::select('study-start-year')->label('Jaar van inschrijving bij de RuG')->range(date('Y')+1, date('Y')-5); !!}
        <div class="form-group">
            <label for="study" class="control-label">Studie en studentnummer (alleen als je dat al hebt)</label>
            <input type="text" class="form-control" value="{{old('study')}}" placeholder="Studie" id="study" name="study">
            <input type="text" class="form-control" value="{{old('student-number')}}" placeholder="s123456" id="student-number" name="student-number">
        </div>

        <h2>Account voor GSVnet</h2>
        <p class="side-helper">Met deze gegevens krijg je toegang tot het forum van de GSV. Als lid krijg je volledig toegang tot de website. Heb je al een account? Vul dan je oude wachtwoord in.</p>
        {!! Former::text('username')->label('Gebruikersnaam')->placeholder('Gebruikersnaam')!!}
        {!! Former::password('password')->label('Wachtwoord')->placeholder('Wachtwoord')!!}
        {!! Former::password('password_confirmation')->label('Herhaal wachtwoord')->placeholder('Herhaal')!!}

        <h2>Gegevens over je ouders</h2>
        <p class="side-helper">Wij zullen deze gegevens alleen gebruiken als het nodig is.</p>
        {!! Former::stacked_radios('parents-same-address')->radios([
            'Ja' => ['name' => 'parents-same-address', 'value' => '1'],
            'Nee' => ['name' => 'parents-same-address', 'value' => '0']
        ])->label('Woon je bij je ouders/verzorgers?')->check('0') !!}

        <div id="parents-info">
            {!! Former::text('parents-address')->label('Adres en huisnummer ouders') !!}
            <div class="form-group">
                <label for="parents-zip-code" class="control-label">Postcode en plaats ouders</label>
                <input type="text" class="form-control" value="{{old('parents-zip-code')}}" placeholder="Postcode" id="parents-zip-code" name="parents-zip-code" size="6">
                <input type="text" class="form-control" value="{{old('parents-town')}}" placeholder="Woonplaats" id="parents-town" name="parents-town">
            </div>
        </div>
        {!! Former::email('parents-email')->label('Emailadres ouders')->required() !!}
        {!! Former::text('parents-phone')->label('Telefoon ouders')->required() !!}

        <h2>Opmerkingen</h2>
        <p class="side-helper">Meld hier ook zus en zo...</p>
        {!! Former::textarea('additional-information')->rows(4)->cols(50)->label('Vragen of opmerkingen?') !!}

    </div>
    <div class="column-holder">
        <div class="control-group">
            <input type="submit" id="submit" value="Meld je aan" class="button">
        </div>
    </div>

{!! Former::close() !!}