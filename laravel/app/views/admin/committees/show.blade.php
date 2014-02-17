@section('content')
    <!-- <a href="{{ URL::action('Admin\CommitteeController@index') }}">Terug naar albums</a> -->
    <div class="page-header">
    <h1>{{{ $committee->name }}}</h1>

    </div>

    <p class=''>
        {{{ $committee->description }}}
    </p>

    <h2>Leden</h2>
    <div class="panel panel-primary">
        <div class="panel-heading">Lid toevoegen</div>
        <div class="panel-body">
            {{
                Former::vertical_open()
                    ->action(action('Admin\Committees\MembersController@store', $committee->id))
                    ->method('POST')
            }}
                {{ Former::text('member')->placeholder('Naam lid')->id('add-user')->label('Lid') }}
                {{ Former::date('start_date')->label('Start datum')}}
                {{ Former::hidden('member_id')->id('add-user-id')}}

                <button type='submit' class='btn btn-success btn-sm'>
                    <i class="glyphicon glyphicon-ok"></i> Opslaan
                </button>

            {{ Former::close() }}
        </div>

        @if ($members->count() > 0)
            <hr>

            <ul class="list-group">
                @foreach ($members as $member)
                    <li class="list-group-item clearfix">
                        {{ $member->full_name }}

                        {{
                            Former::inline_open()
                              ->action(action('Admin\Committees\MembersController@destroy', [$committee->id, $member->id]))
                              ->method('DELETE')
                              ->class('pull-right')
                        }}
                            <button type='submit' class='btn btn-danger btn-xs'>
                                Verwijderen
                                <i class="glyphicon glyphicon-remove"></i>
                            </button>

                        {{
                            Former::close();
                        }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <a href="{{ URL::action('Admin\CommitteeController@edit', $committee->id) }}" alt="Bewerk {{{ $committee->name }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Commissie informatie bewerken
    </a>

    {{-- $users->links() --}}
@stop

@section('javascripts')
    @parent
    <style>
    .typeahead,
    .tt-query,
    .tt-hint {
      width: 396px;
      height: 30px;
      padding: 8px 12px;
      font-size: 24px;
      line-height: 30px;
      border: 2px solid #ccc;
      -webkit-border-radius: 8px;
         -moz-border-radius: 8px;
              border-radius: 8px;
      outline: none;
    }

    .typeahead {
      background-color: #fff;
    }

    .typeahead:focus {
      border: 2px solid #0097cf;
    }

    .tt-query {
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
         -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
              box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    }

    .tt-hint {
      color: #999
    }

    .tt-dropdown-menu {
      width: 422px;
      margin-top: 12px;
      padding: 8px 0;
      background-color: #fff;
      border: 1px solid #ccc;
      border: 1px solid rgba(0, 0, 0, 0.2);
      -webkit-border-radius: 8px;
         -moz-border-radius: 8px;
              border-radius: 8px;
      -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
         -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
              box-shadow: 0 5px 10px rgba(0,0,0,.2);
    }

    .tt-suggestion {
      padding: 3px 20px;
      font-size: 18px;
      line-height: 24px;
    }

    .tt-suggestion.tt-cursor {
      color: #fff;
      background-color: #0097cf;

    }

    .tt-suggestion p {
      margin: 0;
    }

    .gist {
      font-size: 14px;
    }
    </style>
    <script src="/javascripts/components/typeahead.js"></script>

    <script>
        console.log({{ $users->toJson() }});
        var users = {{ $users->toJson() }};

        // instantiate the bloodhound suggestion engine
        var users = new Bloodhound({
          // De tokenizer bepaalt waarop gezocht word
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.firstname + ' ' + d.middlename + ' ' + d.lastname) },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: users
        });

        // initialize the bloodhound suggestion engine
        users.initialize();

        $('#add-user').typeahead(null, {
          name: 'twitter-oss',
          // displayKey: 'firstname',
          displayKey: function(d) { return d.firstname + ' ' + d.middlename + ' ' + d.lastname},
          source: users.ttAdapter(),
          templates: {
            suggestion: Handlebars.compile([
              '<p class="user-fullname">@{{firstname}} @{{middlename}} @{{lastname}}</p>',
            ].join(''))
          }
        });

        $('#add-user').on("typeahead:selected typeahead:autocompleted", function(e, d) {
            $('#add-user-id').val(d.id);
        });
    </script>
@stop
