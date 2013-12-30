@section('content')

    <div class="column-holder" role="main">

        <h1>GSVdocs</h1>

        <div class="main-content">
            <p>
                Hé hallo.
            </p>

            <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Naam</th>
                <td>Toegevoegd op</td>
                <td>Laatst bewerkt</td>
                <td>Download</td>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
            <tr>
                <td>
                    <a href="{{ URL::action('Admin\FilesController@edit', $file->id) }}" alt="{{ $file->name }}">
                       {{{ $file->name }}}
                    </a>
                </td>
                <td>
                    {{{ $file->created_at }}}
                </td>
                <td>
                    {{{ $file->updated_at }}}
                </td>
                <td>
                    <a href="{{{ $file->file_path }}}"><i class="glyphicon glyphicon-download-alt"></i>Download</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $files->links() }}
        </div>

        <div class="secondary-column">
            <div id="labels">
                <h3>Labels</h3>
                    @foreach ($labels as $label)
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" value="{{{ $label->id }}}" name="labels[{{{ $label->id }}}]">
                        {{{ $label->name }}}
                      </label>
                    </div>
                    @endforeach
                </ul>

            </div>
        </div>

    </div>
@stop

