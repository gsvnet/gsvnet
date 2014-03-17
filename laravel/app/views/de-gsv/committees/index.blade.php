@section('content')

    <div class="column-holder" role="main">

        <h1>Commissies</h1>

        <div class="main-content">
            <p class="delta">De GSV heeft honderdmiljoen commissies, waar tweedejaars in kunnen</p>
        </div>

        <div class="secondary-column">
            <div id="committees">
                <div class="form-group">
                    <label class="control-label" for="inputSearch">Zoeken</label>
                    <input type="text" class="search form-control" id="inputSearch" name="inputSearch" placeholder="Zoeken">
                </div>
                <ul class="list secondary-menu">
                    @foreach ($committees as $committee)
                        <li><a class="committee" href="{{ URL::action('AboutController@showCommittee', $committee->unique_name) }}">{{ $committee->name }}</a> <span class="hide slug">({{{$committee->unique_name}}})</span></li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@stop