@extends('layouts.admin')

@section('content')
    <h2>Oud-leden van de GSV</h2>

    <div class="row">
        <div class="col-xs-12 col-md-4 col-md-push-8">
            <h3>Zoeken</h3>
            {!! Former::open_vertical()->method('GET') !!}
            {!! Former::text('zoekwoord')->placeholder('Henk') !!}
            <div class="form-group">
                <label for="jaarverband">Jaarverband</label>
                <select name="jaarverband" id="jaarverband" class="form-control">
                    <option value="0">Doet er niet toe</option>
                    @foreach ($yearGroups as $yearGroup)
                        <option value="{{$yearGroup->id}}" {{Input::get('jaarverband') == $yearGroup->id ? 'selected="selected"' : ''}}>{{$yearGroup->present()->nameWithYear}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="reunist">Reunist</label>
                <select name="reunist" id="reunist" class="form-control">
                    <option value="0">Doet er niet toe</option>
                    <option value="ja" {{Input::get('reunist') == 'ja' ? 'selected="selected"' : ''}}>Ja</option>
                    <option value="nee" {{Input::get('reunist') == 'nee' ? 'selected="selected"' : ''}}>Nee</option>
                </select>
            </div>
            <div class="form-group">
                <label for="regio">Regio</label>
                <select name="regio" id="regio" class="form-control">
                    <option value="0">Maakt niet uit</option>
                    @foreach ($regions as $key => $region)
                        <option value="{{$key}}" {{Input::get('regio') == $key ? 'selected="selected"' : ''}}>{{$region}}</option>
                    @endforeach
                </select>
            </div>
            {!! Former::submit('Zoeken') !!}
            {!! Former::close() !!}
        </div>

        <div class="col-xs-12 col-md-8 col-md-pull-4">
            <div class="table-responsive">
                <table class="table table-striped table-hover sort-table">
                    <thead>
                    <tr>
                        <th>Gebruikersnaam</th>
                        <th>Voornaam</th>
                        <th>tussenvoegsel</th>
                        <th>Achternaam</th>
                        <th>Email</th>
                        <th>Jaarverband</th>
                        <th>Reunist?</th>
                        <th>Familie</th>
                        <th>Laatst bijgewerkt</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($profiles as $profile)
                        <tr>
                            <td>
                                <a href="{{ URL::action('Admin\UsersController@show', $profile->user->id) }}" alt="{{ $profile->user->present()->fullName }}">
                                    {{ $profile->user->username }}
                                </a>
                            </td>

                            <td>{{ $profile->user->firstname }}</td>
                            <td>{{ $profile->user->middlename }}</td>
                            <td>{{ $profile->user->lastname }}</td>
                            <td>{{ $profile->user->email }}</td>
                            @if($profile->yearGroup)
                                <td>{{ $profile->yearGroup->present()->nameWithYear }}</td>
                            @else
                                <td class="text-muted">Onbekend</td>
                            @endif
                            <td>{{ $profile->reunist == 0 ? 'Nee': 'Ja'}}</td>
                            <td><a href="{{ action('Admin\FamilyController@index', [$profile->user->id]) }}" class="btn-xs btn-primary"><i class="fa fa-child"></i></a></td>
                            <td class="text-muted">{{ $profile->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    {!! $profiles->render() !!}
@stop