@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Pas regio van <strong>{{ $user->present()->fullName }}</strong> aan</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Regio aanpassen</h2>

            {!! Former::vertical_open()->action(action('Admin\MemberController@updateRegion', $user->id))->method('PUT') !!}
            {!! Former::populate( $user->profile ) !!}

            <div class="form-group">
                <label for="region">Huidig</label>
                <select name="current_region" id="current_region" class="form-control">
                    <option value="-1">Geen</option>
                    @foreach ($currentRegions as $region)
                        <option value="{{$region->id}}" {{($user->profile->current_region && $user->profile->current_region->id == $region->id) ? 'selected="selected"' : ''}}>{{$region->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="region">Voorheen</label>
                <select multiple name="former_regions[]" id="former_regions" class="form-control" style="height: 150px;">
                    <option value="-1">Geen</option>
                    @foreach ($formerRegions as $region)
                        <option value="{{$region->id}}" {{($user->profile->regions->contains('id', $region->id)) ? 'selected="selected"' : ''}}>{{$region->name}}</option>
                    @endforeach
                </select>
                <small>Houd de control-knop op je toetsenbord in om meerdere oud-regio's te selecteren.</small>
            </div>

            <button type='submit' class='btn btn-success'>
                <i class="glyphicon glyphicon-ok"></i> Opslaan
            </button>

            <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
            {!! Former::close() !!}
        </div>
    </div>
@stop