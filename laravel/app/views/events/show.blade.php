@section('content')
    <div class="column-holder" role="main">

        <div class="main-content">
            <h1>{{ $event->title }}</h1>
            <h3><span class="dag">{{ $event->day() }}</span>
                                <span class="datum">{{ $event->date() }}</span>
                                <span class="tijd">{{ $event->time() }}</span></h3>
            <p class="delta">
                {{ $event->description }}
            </p>

            <strong>Locatie: {{ $event->location }}</strong>
            <div>
                <a class='button' href="{{ URL::previous() }}">Terug</a>
            </div>
        </div>

        <div class="secondary-column">
            <div class="img"><img src="{{ $event->image() }}"  alt="{{ $event->title }}"></div>
        </div>

    </div>
@stop