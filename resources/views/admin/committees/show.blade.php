@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>{{{ $committee->name }}}</h1>
    </div>
    <div class="spacer row">
        <div class="col-xs-12 col-md-6">
            <h2>Beschrijving</h2>
            <p>{{{ $committee->description }}}</p>

            <a href="{{ URL::action([\App\Http\Controllers\Admin\CommitteeController::class, 'edit'], $committee->id) }}" alt="Bewerk {{{ $committee->name }}}" class='btn btn-default'>
                <i class="fa fa-pencil"></i> Commissie informatie bewerken
            </a>
        </div>
        <div class="col-xs-12 col-md-6">
            <h2>Leden</h2>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    Lid toevoegen
                </div>

                <div class="panel-body">
                {!! Former::vertical_open()
                    ->action(action([\App\Http\Controllers\Admin\Committees\MembersController::class, 'store']))
                    ->method('POST') !!}

                {!! Former::hidden('committee_id')->value($committee->id) !!}
                {!! Former::select('member')->placeholder('Naam lid')->id('add-user')->label('Lid')->required() !!}
                {!! Former::text('start_date')->class('form-control datepicker')->label('Geïnstalleerd op')->required() !!}
                {!! Former::checkbox('currently_member')->value('1')->text('Momenteel actief?')->label(null)->check(); !!}
                {!! Former::text('end_date')->class('form-control datepicker')->label('Gedechargeerd op')->help('Je mag dit veld leeg laten als degene nog niet gedechargeerd is') !!}
                {!! Former::hidden('member_id')->id('add-user-id')!!}

                <button type='submit' class='btn btn-success btn-sm'>
                    <i class="glyphicon glyphicon-ok"></i> Opslaan
                </button>

                {!! Former::close() !!}
                </div>
            </div>
        </div>
    </div>


    @if ($members->count() > 0)
    <div class="spacer">
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Van/tot</th>
                <th>Superkrachten</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($members as $member)
                    <tr{{ is_null($member->pivot->end_date) || strtotime($member->pivot->end_date) > strtotime('now') ? ' class="success"' : '' }}>
                        <td>{{ $member->present()->fullName }}</td>
                        <td>{{ $member->present()->committeeFromTo }}</td>
                        <td>
                            {!! Former::inline_open()->action(action([\App\Http\Controllers\Admin\Committees\MembersController::class, 'destroy'], [$member->pivot->id]))->method('DELETE')->class('pull-right') !!}
                            <button type='submit' class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-remove"></i> Verwijderen </button>
                            {!! Former::close() !!}

                            <a href="{{action([\App\Http\Controllers\Admin\Committees\MembersController::class, 'edit'], $member->pivot->id)}}" class="btn btn-default btn-xs pull-right"><i class="fa fa-pencil"></i> Bewerk</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
@stop

@section('javascripts')
    @parent
    <script>
        var selectionOptions = {
            valueField: 'id',
            labelField: 'fullName',
            searchField: 'fullName',
            selectOnTab: true,
            options: [],
            create: false,
            render: {
                option: function(item, escape) {
                    return '<div>' +
                            '<strong class="name">' + escape(item.fullName) + '</strong> ' +
                            '<span class="yearGroup">' + escape(item.yearGroup) + '</span>' +
                            '</div>';
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: '/api/search/members',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        zoekwoord: query
                    },
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        callback(res);
                    }
                });
            }
        };

        $('#add-user').selectize(selectionOptions);
    </script>
@stop