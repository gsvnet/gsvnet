{{ Former::open_vertical_for_files()->action(URL::action('MemberController@store')) }}
    <div class="column-holder" role="main">
        <h2>Informatie over jezelf</h2>
        <div id="preview-image">
        </div>

            {{ Former::file('photo_path')->label('Upload een foto van jezelf')->accept('image') }}
            {{ Former::text('potential-address')->label('Adres')->required() }}
            {{ Former::text('potential-zip-code')->label('Postcode')->size(6)->required() }}
            {{ Former::text('potential-town')->label('Woonplaats')->required() }}
            {{ Former::text('potential-phone')->label('Telefoon')->required() }}
            {{ Former::select('potential-gender')->label('Geslacht')->options(array('male' => 'Man', 'female' => 'Vrouw'))->required() }}

            <div class="inline-form-row {{$errors->has('potential-birthdate') ? ' has-error' : ''}}">
                <label for="potential-birth-day" class="control-label">Geboortedatum<sup>*</sup></label>
                {{
                    Former::select('potential-birth-day')->label('')->range(1, 31);
                }}

                {{
                    Former::select('potential-birth-month')->label('')->options(array(
                        "01" =>"jan",
                        "02" =>"feb",
                        "03" =>"mrt",
                        "04" =>"apr",
                        "05" =>"mei",
                        "06" =>"jun",
                        "07" =>"jul",
                        "08" =>"aug",
                        "09" =>"sep",
                        "10" =>"okt",
                        "11" =>"nov",
                        "12" =>"dec"
                    ))
                }}

                {{ Former::select('potential-birth-year')->label('')->range(date('Y')-14, 1980) }}

                {{ $errors->first('potential-birthdate', '<span class="help-block">:message</span>') }}

            </div>

            {{ Former::text('potential-church')->label('Kerkgezindte')->required() }}
            {{ Former::text('potential-study')->label('Naam van studie')->required() }}
            {{ Former::text('potential-student-number')->label('Studentnummer (alleen als je dat al hebt)')->placeholder('s1234567') }}

        <h2>Gegevens over je ouders</h2>

            {{
                Former::stacked_radios('parents-same-address')->radios(array(
                    'Ja' => array('name' => 'parents-same-address', 'value' => '1'),
                    'Nee' => array('name' => 'parents-same-address', 'value' => '0'),
                ))->label('Woon je bij je ouders/verzorgers?')->check('0')
            }}

            <div id="parents-info">
                {{
                    Former::text('parents-address')->label('Adres')
                }}
                {{
                    Former::text('parents-zip-code')->label('Postcode')->size(6)
                }}
                {{
                    Former::text('parents-town')->label('Woonplaats')
                }}
            </div>
            {{
                Former::text('parents-phone')->label('Telefoon')->required()
            }}

    </div>
    <div class="column-holder">
        <div class="control-group">
            <input type="submit" id="submit" value="Meld je aan" class="button">
        </div>
    </div>
{{Former::close()}}