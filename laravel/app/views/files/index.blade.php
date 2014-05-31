@section('content')
    <div class="column-holder" role="main">

            <h1>GSVdocs</h1>

        <div class="main-content">
            <p>
                Download coole bestanden.
            </p>
            <div class='table-responsive'>
            <table class='table table-bordered table-hover table-condensed'>
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Bijgewerkt op</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $file)
                    <tr>
                        <td>
                        <a href="{{ URL::action('FilesController@show', $file->id) }}">
                          <i class="fa fa-download"></i>
                           {{{ $file->name }}} ({{{ $file->size}}} {{{$file->type }}})
                           </a>
                        </td>
                        <td>
                            {{{ $file->updated_at }}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {{ $files->links() }}

        </div>

        <div class="secondary-column">
            {{
                Former::open()
                ->action(action('FilesController@index'))
                ->method('GET')
            }}

            <ul class='list secondary-menu'>

              <h2>Filter labels</h2>
                @foreach ($labels as $label)
                <li class="list-item">
                  <label>
                    <input type="checkbox" value="{{{ $label->id }}}" name="labels[{{{ $label->id }}}]"
                        <?php
                        // Lelijke code om irritate select boxen te laten checken
                        if (Input::has('labels'))
                        {
                            $labels = Input::get('labels');
                            if (isset($labels[$label->id]))
                            {
                                echo "checked";
                            }
                        }
                        ?>
                    >
                    {{{ $label->name }}}
                  </label>
                </li>
                @endforeach

                <li class="list-item">
                  {{ Former::text('search')->label('Zoeken op naam') }}
                </li>
                </ul>


                <button type='submit' class='button'>
                    <i class='fa fa-search'></i>
                    Zoeken
                </button>
            {{ Former::close() }}
        </div>

    </div>
@stop

