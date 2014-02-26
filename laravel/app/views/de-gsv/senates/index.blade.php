@section('content')

    <div class="column-holder">
        <div class="secondary-column">
            <strong><a href="{{ URL::action('AboutController@showSenates') }}" alt='Senaten'>Senaten</a></strong>
            <div id="senates">
                <ul id="senates-list" class="list secondary-menu to-select-box">
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2013) }}">2013</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2012) }}">2012</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2011) }}">2011</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2010) }}">2010</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2009) }}">2009</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2008) }}">2008</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2007) }}">2007</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2006) }}">2006</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2005) }}">2005</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2004) }}">2004</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2003) }}">2003</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2002) }}">2002</a></li>
                    <li><a class="senate" href="{{ URL::action('AboutController@showSenate', 2001) }}">2001</a></li>
                </ul>
            </div>
        </div>
        <div class="main-content" role="main">
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
    </div>
@stop