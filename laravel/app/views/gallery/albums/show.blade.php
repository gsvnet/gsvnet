<?php
    // Dit moet even mooier gedaan worden hoor
    $classes = ['', 'last-2', 'last-3', 'last-2', 'wide last-2 last-3', '', 'last-2', 'last-3', 'wide last-2', 'last-2 last-3'];
?>

@section('content')
    <div class="column-holder" role="main">
        <h1>{{ $album->name }}</h1>
        <p class="delta">{{ $album->description }}</p>

        <div class="photos">
            @for($i=0; $i<count($photos); $i++)
                @include('gallery._album', array('album' => $photos[$i], 'wide' => ($i==4 || $i==8), 'class' => $classes[$i]))
            @endfor
        </div>

        {{ $photos->links() }}
    </div>
@stop