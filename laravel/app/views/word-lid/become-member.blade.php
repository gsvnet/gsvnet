@if($errors->count() > 0)
 @foreach($errors->all() as $error)
    {{$error}}
 @endforeach
@endif

{{ Former::open_horizontal()->id('become-member')->action(URL::route('post-word-lid'))->enctype('multipart/form-data') }}
    <div class="column-holder" role="main">
        <h1>Word lid!</h1>
        <p class="delta">Door onderstaand formulier in te vullen meld je je aan bij de Gereformeerde Studentenvereniging Groningen</p>

        <div id="preview-image">
        </div>

        <fieldset>
            <legend>Over jou</legend>    
            <div class="form-group">
                <label class="control-label" for="potential-image">Upload een foto van jezelf</label>
                <input type="file" size="10" name="potential-image" id="potential-image" accept="image/*" capture="camera">
            </div>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="potential-address">Adres</label>
                    <input type="text" class="form-control" id="potential-address" name="potential-address" placeholder="Straat en nummer">
                </div>
            </div>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="potential-zip-code">Postcode</label>
                    <input type="text" class="form-control" id="potential-zip-code" name="potential-zip-code" placeholder="1234AB" size="6">
                </div>
                <div class="form-group">
                    <label class="control-label" for="potential-town">Woonplaats</label>
                    <input type="text" class="form-control" id="potential-town" name="potential-town" placeholder="Woonplaats">
                </div>
            </div>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="potential-phone">Telefoon</label>
                    <input type="text" class="form-control" id="potential-phone" name="potential-phone" placeholder="0612345678">
                </div>
            </div>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="potential-gender">Geslacht</label>
                    <select name="potential-gender" id="potential-gender">
                        <option value="male">Man</option>
                        <option value="female">Vrouw</option>
                    </select>
                </div>
            </div>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="potential-birth-day">Geboortedatum</label>
                    <select name="potential-birth-day" id="potential-birth-day">
                        <option value="01">1</option>
                        <option value="02">2</option>
                        <option value="03">3</option>
                        <option value="04">4</option>
                        <option value="05">5</option>
                        <option value="06">6</option>
                        <option value="07">7</option>
                        <option value="08">8</option>
                        <option value="09">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <select name="potential-birth-month" id="potential-birth-month">
                        <option value="01">jan</option>
                        <option value="02">feb</option>
                        <option value="03">mrt</option>
                        <option value="04">apr</option>
                        <option value="05">mei</option>
                        <option value="06">jun</option>
                        <option value="07">jul</option>
                        <option value="08">aug</option>
                        <option value="09">sep</option>
                        <option value="10">okt</option>
                        <option value="11">nov</option>
                        <option value="12">dec</option>
                    </select>
                    <select name="potential-birth-year" id="potential-birth-year">
                    @foreach(range(2000, 1900) as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="potential-church">Kerkgezindte</label>
                    <input type="text" class="form-control" id="potential-church" name="potential-church" placeholder="GKV">
                </div>
            </div>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="potential-study-year">Beginjaar studie</label>
                    <input type="text" class="form-control" id="potential-study-year" name="potential-study-year" placeholder="GKV" size="4">
                </div>
            </div>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="potential-study">Naam van de studie</label>
                    <input type="text" class="form-control" id="potential-study" name="potential-study" placeholder="GKV" size="4">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Over je moeder</legend>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="parents-address">Adres</label>
                    <input type="text" class="form-control" id="parents-address" name="parents-address" placeholder="Straat en nummer">
                </div>
            </div>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="parents-zip-code">Postcode</label>
                    <input type="text" class="form-control" id="parents-zip-code" name="parents-zip-code" placeholder="1234AB" size="6">
                </div>
                <div class="form-group">
                    <label class="control-label" for="parents-town">Woonplaats</label>
                    <input type="text" class="form-control" id="parents-town" name="parents-town" placeholder="Woonplaats">
                </div>
            </div>
            <div class="form-row-horizontal">
                <div class="form-group">
                    <label class="control-label" for="parents-phone">Telefoon</label>
                    <input type="text" class="form-control" id="parents-phone" name="parents-phone" placeholder="0612345678">
                </div>
            </div>
        </fieldset>

    </div>
    <div class="column-holder">
        <div class="control-group">
            <input type="submit" id="submit" value="Meld je aan" class="button">
        </div>
    </div>
{{Former::close()}}