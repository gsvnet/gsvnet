@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h1>{{{ $committee->name }}}</h1>
    </div>
    <div class="spacer row">
        <div class="col-xs-12 col-md-6">
            <h2>Beschrijving</h2>
            <p>{{{ $committee->description }}}</p>

            <a href="{{ URL::action('Admin\CommitteeController@edit', $committee->id) }}" alt="Bewerk {{{ $committee->name }}}" class='btn btn-default'>
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
                    ->action(action('Admin\Committees\MembersController@store'))
                    ->method('POST') !!}

                {!! Former::hidden('committee_id')->value($committee->id) !!}
                {!! Former::text('member')->placeholder('Naam lid')->id('add-user')->label('Lid')->required() !!}
                {!! Former::date('start_date')->label('Geïnstalleerd op')->help('jjjj-mm-dd')->required() !!}
                {!! Former::checkbox('currently_member')->value('1')->text('Momenteel actief?')->label(null)->checked(); !!}
                {!! Former::date('end_date')->label('Gedechargeerd op')->help('jjjj-mm-dd. Je mag dit veld leeg laten als degene nog niet gedechargeerd is') !!}
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
                            {!! Former::inline_open()->action(action('Admin\Committees\MembersController@destroy', [$member->pivot->id]))->method('DELETE')->class('pull-right') !!}
                            <button type='submit' class='btn btn-danger btn-xs'><i class="glyphicon glyphicon-remove"></i> Verwijderen </button>
                            {!! Former::close() !!}

                            <a href="{{URL::action('Admin\Committees\MembersController@edit', $member->pivot->id)}}" class="btn btn-default btn-xs pull-right"><i class="fa fa-pencil"></i> Bewerk</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    {{ $members->render() }}
    </div>
    @endif
@stop

@section('javascripts')
    @parent
    <style>
.twitter-typeahead .tt-hint {
  color: #999999;
}
.twitter-typeahead .tt-input {
  z-index: 2;
}
.twitter-typeahead .tt-input[disabled],
.twitter-typeahead .tt-input[readonly],
fieldset[disabled] .twitter-typeahead .tt-input {
  cursor: not-allowed;
  background-color: #eeeeee !important;
}
.tt-dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  min-width: 160px;
  width: 100%;
  padding: 5px 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 14px;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;
}
.tt-dropdown-menu .tt-suggestion {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.42857143;
  color: #333333;
  white-space: nowrap;
}
.tt-dropdown-menu .tt-suggestion.tt-cursor {
  text-decoration: none;
  outline: 0;
  background-color: #f5f5f5;
  color: #262626;
}
.tt-dropdown-menu .tt-suggestion.tt-cursor a {
  color: #262626;
}
.tt-dropdown-menu .tt-suggestion p {
  margin: 0;
}
    </style>

    <script>
        var list = {{ $users->toJSON() }};
        
        // instantiate the bloodhound suggestion engine
        var users = new Bloodhound({
          // De tokenizer bepaalt waarop gezocht word
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.name) },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: list
        });

        // initialize the bloodhound suggestion engine
        users.initialize();

        $('#add-user').typeahead(null, {
          name: 'twitter-oss',
          // displayKey: 'firstname',
          displayKey: function(d) { return d.name },
          source: users.ttAdapter(),
          templates: {
            suggestion: Handlebars.compile([
              '<p class="user-fullname">@{{name}}</p>',
            ].join(''))
          }
        });

        $('#add-user').on("typeahead:selected typeahead:autocompleted", function(e, d) {
            $('#add-user-id').val(d.id);
        });
    </script>
@stop
