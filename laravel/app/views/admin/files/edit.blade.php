@section('content')
<div class="page-header">
        <h1>{{{ $file->name }}} bewerken</h1>
    </div>

    <section class='create-file panel panel-default'>
        <div class="panel-heading add-item">
            <h4 class="panel-title"><i class="fa fa-pencil"></i> {{{ $file->name }}} bewerken<span class="caret"></span></h4>
        </div>

        {{
            Former::open_vertical_for_files()
                ->action(action('Admin\FilesController@update', $file->id))
                ->rules(Model\File::$rules)
                ->method('put')
                ->class('panel-body add-form')
        }}

            {{ Former::populate($file) }}

            @include('admin.files._form')

            <button type='submit' class='btn btn-success'>
                <i class="fa fa-check"></i> Opslaan
            </button>

        {{
            Former::close()
        }}
    </section>

    <hr>

    <p>Of verwijder het bestand.</p>

    {{
        Former::inline_open()
          ->action(action('Admin\FilesController@destroy', $file->id))
          ->method('DELETE')
    }}
        <button type='submit' class='btn btn-danger'>
            <i class="glyphicon glyphicon-trash"></i> Verwijderen
        </button>

    {{
        Former::close();
    }}
@stop

@section('javascripts')
    @parent

    <script>
    $('.btn-danger').click( function() {
        return confirm('Zeker weten?');
    });
    $(document).ready(function() {
        $('.add-item').on('click', function () {
            $('.add-form').toggle('fast');
        });
        // Hide success message after 2.5 seconds
        $('.alert.alert-success').delay(2500).slideUp(500);
    });
    </script>
@stop