@section('content')
    <!-- <a href="{{ URL::action('Admin\CommitteeController@index') }}">Terug naar albums</a> -->
    <div class="page-header">
    <h1>{{{ $committee->name }}}</h1>

    </div>

    <p class=''>
        {{{ $committee->description }}}
    </p>

    <a href="{{ URL::action('Admin\CommitteeController@edit', $committee->id) }}" alt="Bewerk {{{ $committee->name }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Commissie informatie bewerken
    </a>

    @if ($members->count() > 0)
    <h2>Leden</h2>

    <div class="row">

        <div class="col-md-6">
            <ul class="list-group">
                @foreach ($members as $member)
                    <li class="list-group-item">{{ $member->firstname }}</li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            <ul class="list-group">
                <li href="#" class="list-group-item list-group-item-info">
                    <h3 class="list-group-item-heading">Leden toevoegen</h3>
                </li>

                <li href="#" class="list-group-item active">
                    <h4 class="list-group-item-heading">Zoeken</h4>
                    {{
                        Former::open_vertical_for_files()
                            ->action('')
                            ->method('POST')
                    }}
                    {{ Former::text('search')->label(null) }}
                    {{ Former::close() }}
              </li>
                @foreach ($users as $user)
                    <li class="list-group-item">
                    <button class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-plus"></i>
                    </button>
                    {{ $user->full_name }}
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
    @else

    <a href="{{ URL::action('Admin\Committees\MemberController@edit', $committee->id) }}" alt="Bewerk {{{ $committee->name }}}" class='btn btn-success'>
        <i class="fa fa-check"></i> Leden toevoegen
    </a>

    @endif
    @if ( 1==2 )

    <section class='create-album panel panel-default panel-info'>
        <div class="panel-heading add-item">
            <h4 class="panel-title"><i class="fa fa-plus"></i> Leden toevoegen <span class="caret"></span></h4>
        </div>

        {{
            Former::open_vertical_for_files()
                ->action(action('Admin\Committees\MemberController@store', $committee->id))
                ->method('POST')
                ->class('panel-body add-form')
        }}

            @include('admin.committees.members._form')

            <button type='submit' class='btn btn-success'>
                <i class="fa fa-check"></i> Toevoegen
            </button>

        {{
            Former::close()
        }}

    </section>

    <section>

    </section>
    @endif

    {{-- $users->links() --}}
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/magnific-popup-0.9.4.js"></script>
    <script src="/javascripts/fotos.js"></script>
@stop
