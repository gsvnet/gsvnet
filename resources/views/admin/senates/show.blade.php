@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>{{ $senate->name }}</h1>
    </div>
    <a href="{{ URL::action('Admin\SenateController@edit', $senate->id) }}" alt="Bewerk {{{ $senate->name }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Senaatsinformatie bewerken
    </a>

    <h2>Leden</h2>
    <div class="panel panel-primary">
        <div class="panel-heading">Lid toevoegen</div>
        <div class="panel-body">
            {!! Former::vertical_open()
                ->action(action('Admin\Senates\MembersController@store', $senate->id))
                ->method('POST') !!}

                {!! Former::select('member')->placeholder('Naam lid')->id('add-user')->label('Lid') !!}
                {!! Former::select('function')->options(Config::get('gsvnet.senateFunctions'))->label('Functie') !!}
                {!! Former::hidden('member_id')->id('add-user-id')!!}

                <button type='submit' class='btn btn-success btn-sm'>
                    <i class="glyphicon glyphicon-ok"></i> Opslaan
                </button>

            {!! Former::close() !!}
        </div>

        @if ($members->count() > 0)
            <hr>

            <ul class="list-group">
                @foreach ($members as $member)
                    <li class="list-group-item clearfix">
                        {{ $member->present()->fullName }} <span class="text-muted">({{ $member->present()->senateFunction }})</span>

                        {!! Former::inline_open()
                              ->action(action('Admin\Senates\MembersController@destroy', [$senate->id, $member->id]))
                              ->method('DELETE')
                              ->class('pull-right')
                        !!}
                            <button type='submit' class='btn btn-danger btn-xs'>
                                Verwijderen
                                <i class="glyphicon glyphicon-remove"></i>
                            </button>

                        {!! Former::close() !!}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
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
