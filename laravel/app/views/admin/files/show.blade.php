@section('content')
    <!-- <a href="{{ URL::action('Admin\FilesController@index') }}">Terug naar files</a> -->
    <div class="page-header">
        <h1>{{{ $file->name }}}</h1>
    </div>

    <section class='create-file panel panel-default'>
        <div class="panel-heading add-item">
            <h4 class="panel-title">{{{ $file->name }}} bewerken<span class="caret"></span></h4>
        </div>

        {{
            Former::open_vertical_for_files()
                ->action(action('Admin\FilesController@update', $file->id))
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

    <section class="labels">
        <h2>Labels</h2>

        <ul>
            @foreach($labels as $label)
                <li>{{{ $label->name }}}</li>
            @endforeach

        </ul>

    </section>


@stop

@section('javascripts')
    @parent
    <script src="/packages/frozennode/administrator/js/jquery/select2/select2.js"></script>
    <script>
        $(document).ready(function() {
            $("#e12").select2({tags:["red", "green", "blue"]});

            $('.add-item').on('click', function () {
                $('.add-form').toggle('fast');
            });
            // Hide success message after 2.5 seconds
            $('.alert.alert-success').delay(2500).slideUp(500);
        });
    </script>
@stop
