@section('content')

    <div class="column-holder" role="main">

        <h1>Commissies</h1>

        <div class="main-content">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe vel quos iure ipsam sequi quasi accusantium qui quas. Exercitationem, odio ab minima officiis corporis ex blanditiis consequuntur culpa nam quas.
            </p>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, reprehenderit, quaerat facilis possimus perspiciatis maxime id saepe laboriosam vitae rem totam nulla sapiente sed fuga sequi. Suscipit, itaque, facere quas ipsa ratione pariatur quibusdam voluptatum qui fugit tempora maiores sint provident optio laborum aperiam harum saepe natus numquam inventore debitis ab distinctio reprehenderit perspiciatis et officiis molestiae incidunt obcaecati dolores nulla iure sed earum illum odio nobis dolorum nesciunt accusamus quia dolore consectetur aspernatur. Ratione fugit molestiae autem quia aspernatur.
            </p>
        </div>

        <div class="secondary-column">
            <div id="committees">
                <div class="form-group">
                    <label class="control-label" for="inputSearch">Zoeken</label>
                    <input type="text" class="search form-control" id="inputSearch" name="inputSearch" placeholder="Zoeken">
                </div>
                <ul class="list secondary-menu">
                    @foreach ($committees as $committee)
                        <li><a class="committee" href="{{ URL::action('AboutController@showCommittee', $committee->id) }}">{{ $committee->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@stop