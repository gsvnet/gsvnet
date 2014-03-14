@extends('layouts.default')

@section('content')
    
    <div class="column-holder">
        <h1>Forum</h1>
        
        <section class="main-content forum">

            @if(Input::has('tags'))
                <div class="tags">Onderwerpen met de tags {{ Input::get('tags') }}.</div>
            @else
                <div class="tags">Alle ondewerpen</div>
            @endif

            @if($threads->count() > 0)
                @foreach($threads as $thread)
                    @include('forum._thread_summary')
                @endforeach

                {{ str_replace('%2C', ',', $threads->links()) }}
            @else
                <div>
                    Er zijn nu geen onderwerpen voor de geselecteerde categorie.
                </div>
            @endif
        </section>

        <div class="secondary-column">
            @include('forum._sidebar')
        </div>
    </div>
@stop