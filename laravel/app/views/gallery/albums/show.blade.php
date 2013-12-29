@section('content')
    <div class="column-holder" role="main">
        <h1>{{ $album->name }}</h1>
        <p class="delta">{{ $album->description }}</p>

        <!-- <div class="photos">
            @foreach(array_chunk($photos->getCollection()->all(), 3) as $row)
                <div class="photo-grid-row">
                    @foreach($row as $photo)
                        @include('gallery._album', array('album' => $photo, 'first' => 'first', 'wide' => ''))
                    @endforeach
                </div>
            @endforeach
        </div> -->

        <div class="photos">
            <div class="photo-grid-row">
                @include('gallery._album', array('album' => $photos[0], 'first' => 'first', 'wide' => ''))
                @include('gallery._album', array('album' => $photos[1], 'first' => '', 'wide' => ''))
                @include('gallery._album', array('album' => $photos[2], 'first' => '', 'wide' => ''))
            </div>
            <div class="photo-grid-row">
                @include('gallery._album', array('album' => $photos[4], 'first' => 'first', 'wide' => 'wide'))
                @include('gallery._album', array('album' => $photos[5], 'first' => '', 'wide' => ''))
            </div>
            <div class="photo-grid-row">
                @include('gallery._album', array('album' => $photos[5], 'first' => 'first', 'wide' => ''))
                @include('gallery._album', array('album' => $photos[6], 'first' => '', 'wide' => ''))
                @include('gallery._album', array('album' => $photos[7], 'first' => '', 'wide' => ''))
            </div>
            <div class="photo-grid-row">
                @include('gallery._album', array('album' => $photos[8], 'first' => 'first', 'wide' => ''))
                @include('gallery._album', array('album' => $photos[9], 'first' => '', 'wide' => 'wide'))
            </div>
        </div>

        {{ $photos->links() }}
    </div>
@stop

@section('javascripts')
    @parent
    <script src="/javascripts/fotos.js"></script>
@stop