<div>
    <h3>GSV-gegevens</h3>
    <div class="form-group">
        <label for="region" class="control-label">Regio</label>
        <select class="form-control" id="region" name="region">
            <option value="onbekend">Geen</option>
            @foreach(Config::get('gsvnet.regions') as $id => $name)
                <option value="{{$id}}" {!! $profile->region == $id ? 'selected="selected"' : '' !!}>{{$name}}</option>
            @endforeach
        </select>
    </div>
    {!! Former::select('year_group_id')->label('Jaarverband')->fromQuery($yearGroups, 'name', 'id') !!}
    {!! Former::text('inauguration_date')->class('form-control datepicker')->dataValue($profile->inauguration_date)->label('Inauguratiedatum') !!}

    @if($user->isFormerMember())
        {!! Former::text('resignation_date')->class('form-control datepicker')->dataValue($profile->resignation_date)->label('Bedankdatum') !!}
        {!! Former::select('reunist')->text('Reunist')->options(['0' => 'Nee', '1' => 'Ja']) !!}
    @endif
</div>
<div>
    <h3>Persoonsgegevens</h3>
    {!! Former::select('gender')->label('Geslacht')->options(array('1' => 'Man', '0' => 'Vrouw')) !!}
    {!! Former::text('initials')->label('Initialen') !!}
    {!! Former::text('birthdate')->class('form-control birthday-picker')->dataValue($profile->birthdate)->label('Geboortedatum') !!}
    {!! Former::text('phone')->label('Telefoon') !!}
    {!! Former::text('address')->label('Adres') !!}
    {!! Former::text('zip_code')->label('Postcode') !!}
    {!! Former::text('town')->label('Woonplaats') !!}
    {!! Former::text('study')->label('Studie') !!}
    {!! Former::text('student_number')->label('Studentnummer') !!}
    {!! Former::text('church')->label('Kerk') !!}
</div>

@if($user->isFormerMember())
<div>
    <h3>Burgerlevengegevens</h3>
    {!! Former::text('company')->label('Bedrijf') !!}
    {!! Former::text('profession')->label('Functie') !!}
</div>
@endif

@if($user->isMember())
<div>
    <h3>Natuurlijke ouders</h3>
    {!! Former::text('parent_phone')->label('Telefoon ouders') !!}
    {!! Former::text('parent_address')->label('Adres ouders') !!}
    {!! Former::text('parent_zip_code')->label('Postcode ouders') !!}
    {!! Former::text('parent_town')->label('Woonplaats ouders') !!}
</div>
@endif
