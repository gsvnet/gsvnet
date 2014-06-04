@section('content')
    <!-- <a href="{{ URL::action('Admin\SenateController@index') }}">Terug naar albums</a> -->
    <div class="page-header">
      <h1>{{{ $senate->name }}}</h1>
    </div>
    <a href="{{ URL::action('Admin\SenateController@edit', $senate->id) }}" alt="Bewerk {{{ $senate->name }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Senaatsinformatie bewerken
    </a>

    <blockquote> {{ $senate->body }} </blockquote>

    <h2>Leden</h2>
    <div class="panel panel-primary">
        <div class="panel-heading">Lid toevoegen</div>
        <div class="panel-body">
            {{
                Former::vertical_open()
                    ->action(action('Admin\Senates\MembersController@store', $senate->id))
                    ->method('POST')
            }}
                {{ Former::text('member')->placeholder('Naam lid')->id('add-user')->label('Lid') }}
                {{ Former::select('function')->options(Config::get('gsvnet.senateFunctions'))->label('Functie') }}
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
                        {{ $member->present()->fullName }} <span class="text-muted">({{ $member->present()->senateFunction }})</span>

                        {{
                            Former::inline_open()
                              ->action(action('Admin\Senates\MembersController@destroy', [$senate->id, $member->id]))
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

    {{-- $users->links() --}}
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
        var users = {{ $users->toJson() }};

        console.log(users);

        // instantiate the bloodhound suggestion engine
        var users = new Bloodhound({
          // De tokenizer bepaalt waarop gezocht word
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.name) },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: users
        });

        // initialize the bloodhound suggestion engine
        users.initialize();

        $('#add-user').typeahead(null, {
          name: 'twitter-oss',
          // displayKey: 'firstname',
          displayKey: function(d) { return d.name},
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
