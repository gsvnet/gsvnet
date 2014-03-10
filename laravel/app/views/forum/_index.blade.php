@extends('layouts.default')

@section('content')
    <div class="column-holder">
        <section class="main-content forum">
            <h1>Forum</h1>

            @if(Input::has('tags'))
                <div class="tags">Threads tagged with {{ Input::get('tags') }}.</div>
            @else
                <div class="tags">All threads</div>
            @endif

            @if($threads->count() > 0)
                @foreach($threads as $thread)
                    @include('forum._thread_summary')
                @endforeach

                {{ str_replace('%2C', ',', $threads->links()) }}
            @else
                <div>
                    There are currently no threads for the selected category.
                </div>
            @endif
        </section>

        <div class="secondary-column">
            @include('forum._sidebar')
        </div>
    </div>
@stop