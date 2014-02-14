@section('content')
    <!-- <a href="{{ URL::action('Admin\CommitteeController@index') }}">Terug naar albums</a> -->
    <div class="page-header">
    <h1>{{{ $committee->name }}}</h1>

    </div>

    <p class=''>
        {{{ $committee->description }}}
    </p>

    @if ($members->count() > 0)
    <h2>Leden</h2>
        <ul class="list-group">
            @foreach ($members as $member)
                <li class="list-group-item">{{ $member->full_name }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ URL::action('Admin\CommitteeController@edit', $committee->id) }}" alt="Bewerk {{{ $committee->name }}}" class='btn btn-default'>
        <i class="fa fa-pencil"></i> Commissie informatie bewerken
    </a>
    {{-- $users->links() --}}
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/magnific-popup-0.9.4.js"></script>
    <script src="/javascripts/fotos.js"></script>
@stop
