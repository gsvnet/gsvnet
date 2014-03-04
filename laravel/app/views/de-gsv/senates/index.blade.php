@section('content')

    <div class="column-holder">
        <h1>Senaten</h1>
        <div class="secondary-column">
            <h2><a href="{{ URL::action('AboutController@showSenates') }}" title="Alle senaten">Senaten</a></h2>
            <div id="senates">
                @if(count($senates) > 0)
                <ul id="senates-list" class="list secondary-menu to-select-box">
                    @foreach($senates as $senate)
                        <li class="senate"><a href="{{{URL::action('AboutController@showSenate', array($senate->id))}}}">{{{$senate->nameWithYear}}}</a></li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
        <div class="main-content" role="main">
        @section('senate')

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe vel quos iure ipsam sequi quasi accusantium qui quas. Exercitationem, odio ab minima officiis corporis ex blanditiis consequuntur culpa nam quas.
            </p>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, reprehenderit, quaerat facilis possimus perspiciatis maxime id saepe laboriosam vitae rem totam nulla sapiente sed fuga sequi. Suscipit, itaque, facere quas ipsa ratione pariatur quibusdam voluptatum qui fugit tempora maiores sint provident optio laborum aperiam harum saepe natus numquam inventore debitis ab distinctio reprehenderit perspiciatis et officiis molestiae incidunt obcaecati dolores nulla iure sed earum illum odio nobis dolorum nesciunt accusamus quia dolore consectetur aspernatur. Ratione fugit molestiae autem quia aspernatur.
            </p>
        @show
        </div>
    </div>
@stop