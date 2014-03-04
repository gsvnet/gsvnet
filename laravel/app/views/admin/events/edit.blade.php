@section('content')
    <h2>Activiteit bewerken</h2>

    {{
        Former::vertical_open()
            ->action(action('Admin\EventController@update', $event->id))
            ->method('PUT')
    }}
        {{ Former::populate( $event->resource ) }}
        {{ Former::populateField('start_date', $event->startDateYearMonthDay)) }}

        @include('admin.events._form')

        <button type='submit' class='btn btn-success'>
            <i class="glyphicon glyphicon-ok"></i> Opslaan
        </button>

        <a class='btn btn-default' href="{{ URL::previous() }}">Terug</a>
    {{
        Former::close()
    }}

    <hr>

    <p>Of verwijder de activiteit.</p>

    {{
        Former::inline_open()
          ->action(action('Admin\EventController@destroy', $event->id))
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
        $(document).ready(function() {
            var startTime = $('#start_time')[0];
            var endTime = $('#end_time')[0];
            var $wholeDay = $('#whole_day');


            $('.btn-danger').click( function() {
                return confirm('Zeker weten?');
            });

            function toggleTimeBoxes() {
                startTime.disabled = $wholeDay[0].checked;
                endTime.disabled = $wholeDay[0].checked;
            }

            $wholeDay.change(toggleTimeBoxes);
            toggleTimeBoxes();
        });
    </script>
@stop