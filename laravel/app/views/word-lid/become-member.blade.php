{{ Former::open_vertical_for_files()->id('become-member')->action(URL::action('UserController@postWordLid')) }}
    <div class="column-holder" role="main">
        <h1>Word lid!</h1>
        <p class="delta">{{Auth::user()->firstname}}, door onderstaand formulier in te vullen meld je je aan bij de Gereformeerde Studentenvereniging Groningen</p>

        <div id="preview-image">
        </div>

            {{
                Former::file('potential-image')->label('Upload een foto van jezelf')->accept('image')
            }}
            {{
                Former::text('potential-address')->label('Adres')
            }}
            {{
                Former::text('potential-zip-code')->label('Postcode')->size(6)
            }}
            {{
                Former::text('potential-town')->label('Woonplaats')
            }}
            {{
                Former::text('potential-phone')->label('Telefoon')
            }}
            {{
                Former::select('potential-gender')->label('Geslacht')->options(array('male' => 'Man', 'female' => 'Vrouw'))
            }}

            <div class="inline-form-row">
            <label for="potential-birth-day" class="control-label">Geboortedatum</label>
            {{
                Former::select('potential-birth-day')->label('')->options(array(
                    '01' => '01',
                    '02' => '02',
                    '03' => '03',
                    '04' => '04',
                    '05' => '05',
                    '06' => '06',
                    '07' => '07',
                    '08' => '08',
                    '09' => '09',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                    '13' => '13',
                    '14' => '14',
                    '15' => '15',
                    '16' => '16',
                    '17' => '17',
                    '18' => '18',
                    '19' => '19',
                    '20' => '20',
                    '21' => '21',
                    '22' => '22',
                    '23' => '23',
                    '24' => '24',
                    '25' => '25',
                    '26' => '26',
                    '27' => '27',
                    '28' => '28',
                    '29' => '29',
                    '30' => '30',
                    '31' => '31'
                ))
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

            {{
                Former::select('potential-birth-year')->label('')->range(date('Y')-14, 1980)
            }}
            </div>
            {{
                Former::text('potential-church')->label('Kerkgezindte')
            }}
            {{
                Former::text('potential-study')->label('Naam van studie')
            }}
            {{
                Former::text('potential-study-year')->label('Jaar waarin je begon of begint met studeren')
            }}

            {{
                Former::stacked_radios('parents-same-address')->radios(array(
                    'Ja' => array('name' => 'parents-same-address', 'value' => '1'),
                    'Nee' => array('name' => 'parents-same-address', 'value' => '0'),
                ))->label('Woon je bij je ouders/verzorgers?')->check('0')
            }}

        <fieldset id="parents-info">
            <legend>Over je moeder</legend>
            {{
                Former::text('parents-address')->label('Adres')
            }}
            {{
                Former::text('parents-zip-code')->label('Postcode')->size(6)
            }}
            {{
                Former::text('parents-town')->label('Woonplaats')
            }}
            {{
                Former::text('parents-phone')->label('Telefoon')
            }}
        </fieldset>

    </div>
    <div class="column-holder">
        <div class="control-group">
            <input type="submit" id="submit" value="Meld je aan" class="button">
        </div>
    </div>
{{Former::close()}}