@section('content')

    <div class="column-holder" role="main">
        <h1>{{ $committee->name }}</h1>

        <div class="main-content">
            <p>
                {{ $committee->description }}
            </p>

            <h2>Leden</h2>

            <ul>
                @foreach ($committee->active_users as $user)
                    <li>
                        {{ $user->fullname }}
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="secondary-column">
            <form method="POST" action="/login">
                <div class="form-group">
                    <label class="control-label" for="inputSearch">Zoeken</label>
                    <input type="text" class="form-control" id="inputSearch" name="inputSearch" placeholder="Zoeken">
                </div>
            </form>
            <ul class="secondary-menu">
                @foreach ($committees as $committee)
                    <li><a href="{{ URL::route('show_committee', $committee->id) }}">{{ $committee->name }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>
@stop
