@section('content')
    <!-- <a href="{{ URL::action('Admin\CommitteeController@index') }}">Terug naar albums</a> -->
    <div class="page-header">
    <h1>{{{ $committee->name }}}</h1>

    </div>

    <p class=''>
        {{{ $committee->description }}}
    </p>

    <a href="{{ URL::action('Admin\CommitteeController@edit', $committee->id) }}" alt="Bewerk {{{ $committee->name }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Album informatie bewerken
    </a>

    <h2>Leden</h2>
    <section class='create-album panel panel-default panel-info'>
        <div class="panel-heading add-item">
            <h4 class="panel-title"><i class="fa fa-plus"></i> Lid toevoegen <span class="caret"></span></h4>
        </div>

        {{
            Former::open_vertical_for_files()
                ->action(action('Admin\PhotoController@store', $committee->id))
                ->method('POST')
                ->class('panel-body add-form')
        }}

            @include('admin.photos._form')

            <button type='submit' class='btn btn-success'>
                <i class="fa fa-check"></i> Toevoegen
            </button>

        {{
            Former::close()
        }}

    </section>

    <section>
        <ul>
            @foreach ($users as $user)
                <li>{{ $user }}</li>
            @endforeach
        </ul>
    </section>

    {{-- $users->links() --}}
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/magnific-popup-0.9.4.js"></script>
    <script src="/javascripts/fotos.js"></script>
@stop
