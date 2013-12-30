{{ Former::open_vertical_for_files()->id('become-member')->action(URL::route('post-word-lid')) }}
    <div class="column-holder" role="main">
        <h1>Word lid!</h1>
        <p class="delta">{{Auth::user()->firstname}}, door onderstaand formulier in te vullen meld je je aan bij de Gereformeerde Studentenvereniging Groningen</p>

        <div id="preview-image">
        </div>

        <fieldset>
            <legend>Over jou</legend>
            {{
                Former::file('potential-image')->label('Upload een foto van jezelf')->accept('image')
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
                Former::select('potential-gender')->label('Telefoon')->options(array('male' => 'Man', 'female' => 'Vrouw'))
            }}
            
            <div class="row">
                <div class='col-xs-2'>            
                {{
                    Former::select('potential-birth-day')->label('')->options(range(1, 31))
                }}
                </div>
                <div class='col-xs-2'>                
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
                </div>
                <div class='col-xs-2'>                
                {{
                    Former::select('potential-birth-year')->label('')->options(range(date('Y')-14, 1900))
                }}
                </div>
            </div>
            {{ Former::framework('TwitterBootstrap3'); }}
            {{
                Former::text('potential-church')->label('Kerkgezindte')
            }}
            {{
                Former::text('potential-study')->label('Naam van studie')
            }}
            {{
                Former::text('potential-study-year')->label('Jaar waarin je begon of begint met studeren')
            }}
        </fieldset>

        <fieldset>
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