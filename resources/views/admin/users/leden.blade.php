@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Leden van de GSV</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-3 col-md-push-9">
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
                <label for="regio">Regio</label>
                <select name="regio" id="regio" class="form-control">
                    <option value="0">Maakt niet uit</option>
                    @foreach ($regions as $region)
                        <option value="{{$region->id}}" {{Input::get('regio') == $region->id ? 'selected="selected"' : ''}}>{{$region->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i> Filteren
            </button>
            {!! Former::close() !!}
        </div>
        <div class="col-xs-12 col-md-9 col-md-pull-3">
            <div class="table-responsive">
                <table class='table table-striped table-hover sort-table'>
                    <thead>
                        <tr>
                            <th>Voornaam</th>
                            <th>t/v</th>
                            <th>Achternaam</th>
                            <th>Jaarverband</th>
                            <th>Geverifieerd</th>
                            <th>Laatst bijgewerkt</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($profiles as $profile)
                        <tr>
                            <td>
                                <a href="{{ URL::action('Admin\UsersController@show', $profile->user->id) }}" alt="{{ $profile->user->present()->fullName }}">
                                    {{ $profile->user->firstname }}
                                </a>
                            </td>
                            <td>{{ $profile->user->middlename }}</td>
                            <td>{{ $profile->user->lastname }}</td>
                            @if($profile->yearGroup)
                                <td>{{ $profile->yearGroup->present()->nameWithYear }}</td>
                            @else
                                <td class="text-muted">Onbekend</td>
                            @endif
                            <td>
                                @if($profile->user->isVerified())
                                    Ja
                                @else
                                    <a href="{{action('Malfonds\InvitationController@create', $profile->user->id)}}">Uitnodigen</a>
                                @endif
                            </td>
                            <td class="text-muted">{{ $profile->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {!! $profiles->render() !!}
        </div>
    </div>
@stop