@section('content')

    <div class="column-holder" role="main">
        <div class="main-content">
        @section('senate')
            <h1>Senaten</h1>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe vel quos iure ipsam sequi quasi accusantium qui quas. Exercitationem, odio ab minima officiis corporis ex blanditiis consequuntur culpa nam quas.
            </p>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, reprehenderit, quaerat facilis possimus perspiciatis maxime id saepe laboriosam vitae rem totam nulla sapiente sed fuga sequi. Suscipit, itaque, facere quas ipsa ratione pariatur quibusdam voluptatum qui fugit tempora maiores sint provident optio laborum aperiam harum saepe natus numquam inventore debitis ab distinctio reprehenderit perspiciatis et officiis molestiae incidunt obcaecati dolores nulla iure sed earum illum odio nobis dolorum nesciunt accusamus quia dolore consectetur aspernatur. Ratione fugit molestiae autem quia aspernatur.
            </p>
        @show
        </div>

        <div class="secondary-column">
            <strong><a href="{{ URL::action('AboutController@showSenates') }}" alt='Senaten'>Senaten</a></strong>
            <div id="senates">
                <ul class="list secondary-menu">
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2013) }}">2013</a></li>
                </ul>
            </div>
        </div>

    </div>
@stop