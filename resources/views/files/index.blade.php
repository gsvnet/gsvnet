@extends('layouts.default')

@section('title', 'GSVdocs')
@section('description', 'GSVdocs is de plaats waar alle documentjes van de GSV komen te staan')
@section('body-id', 'files-page')

@section('content')
    <div class="column-holder" role="main">
        <h1>GSVdocs</h1>

        <div class="main-content">
            <p>
                Al wat u ontbreekt, schenkt GSVdocs als u erom smeekt.
            </p>
            <div class='table-responsive'>
            <table class='table table-bordered table-hover table-condensed'>
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Laatste update</th>
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
                            {{{ $file->present()->updated_ago }}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            {!! $files->render() !!}

        </div>

        <div class="secondary-column">
            {!! Former::open()
                ->action(action('FilesController@index'))
                ->method('GET') !!}

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
                                        echo "checked";
                                }
                                ?>
                                >
                                {{ $label->name }}
                            </label>
                        </li>
                    @endforeach

                    <li class="list-item">
                        {!! Former::text('search')->label('Zoeken op naam') !!}
                    </li>
                </ul>

                <button type='submit' class='button'>
                    <i class='fa fa-search'></i> Zoeken
                </button>
            {!! Former::close() !!}
        </div>
    </div>
@stop

