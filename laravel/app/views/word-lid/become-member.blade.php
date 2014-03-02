{{ Former::open_vertical_for_files()->action(URL::action('MemberController@store')) }}
    <div class="column-holder" role="main">
        <h1>Word lid!</h1>
        <p class="delta">{{Auth::user()->firstname}}, door onderstaand formulier in te vullen meld je je aan bij de Gereformeerde Studentenvereniging Groningen</p>

        <h2>Informatie over jezelf</h2>
        <div id="preview-image">
        </div>

            {{ Former::file('potential-image')->label('Upload een foto van jezelf')->accept('image') }}
            {{ Former::text('potential-address')->label('Adres') }}
            {{ Former::text('potential-zip-code')->label('Postcode')->size(6) }}
            {{ Former::text('potential-town')->label('Woonplaats') }}
            {{ Former::text('potential-phone')->label('Telefoon') }}
            {{ Former::select('potential-gender')->label('Geslacht')->options(array('male' => 'Man', 'female' => 'Vrouw')) }}

            <div class="inline-form-row {{$errors->has('potential-birthdate') ? ' has-error' : ''}}">
                <label for="potential-birth-day" class="control-label">Geboortedatum</label>
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

            {{ Former::text('potential-church')->label('Kerkgezindte') }}
            {{ Former::text('potential-study')->label('Naam van studie') }}
            {{ Former::select('potential-study-year')->range(date('Y')+1, date('Y')-4)->label('Jaar waarin je begon of begint met studeren') }}

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
                Former::text('parents-phone')->label('Telefoon')
            }}

    </div>
    <div class="column-holder">
        <div class="control-group">
            <input type="submit" id="submit" value="Meld je aan" class="button">
        </div>
    </div>
{{Former::close()}}