@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Familiegegevens van {{$user->present()->fullName}} bewerken</h1>
    </div>

    {!! Former::vertical_open() !!}
    <div class="control-group">
        <label for="parentId" class="control-label">Ouder</label>
        <div class="controls">
            <select id="parentId" name="parentId">
                @if($parent)
                    <option value="{{$parent->id}}" selected="selected">{{$parent->present()->fullName}}</option>
                @endif
            </select>
        </div>
    </div>
    <div class="control-group">
        <label for="childrenIds" class="control-label">Kinderen</label>
        <div class="controls">
            <select id="childrenIds" name="childrenIds[]" multiple="multiple">
                @foreach($children as $child)
                    <option value="{{$child->id}}" selected="selected">{{$child->present()->fullName}}</option>
                @endforeach
            </select>
        </div>
    </div>
    {!! Former::submit('Opslaan') !!}
    {!! Former::close() !!}
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

        $('#childrenIds').selectize(selectionOptions);
        $('#parentId').selectize(selectionOptions);
    </script>
@stop