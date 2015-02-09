@extends('layouts.default')

@section('content')
    
    <div class="column-holder">
        <h1>Forum</h1>
        @if(Input::has('tags'))
            <p class="tags delta">Onderwerpen met de tags {{{ Input::get('tags') }}}.</p>
        @else
            <p class="tags">Alle onderwerpen</p>
        @endif
        
        <section class="main-content forum">
            @include('partials.ads')

            @if($threads->count() > 0)
                @foreach($threads as $thread)
                    @include('forum._thread_summary')
                @endforeach

                {{ str_replace('%2C', ',', $threads->links()) }}
            @else
                <p>Er zijn nu geen onderwerpen voor de geselecteerde categorie.</p>
            @endif
        </section>

        <div class="secondary-column">
            @include('forum._sidebar')
        </div>
    </div>
@stop