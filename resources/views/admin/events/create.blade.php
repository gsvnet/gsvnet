@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1><i class="fa fa-plus"></i> Activiteit toevoegen</h1>
    </div>
    <div class="spacer row">
        <div class="col-xs-12 col-md-6">
            <section class="create-event">

                {!! Former::vertical_open()
                    ->action(action('Admin\EventController@store'))
                    ->method('POST') !!}

                @include('admin.events._form')

                <button type='submit' class='btn btn-success'>
                    <i class="fa fa-check"></i> Toevoegen
                </button>

                {!! Former::close() !!}
            </section>
        </div>
        <div class="col-xs-12 col-md-6">
            <h2>Tips voor het toevoegen</h2>
            <ul>
                <li>Je titel moet even goed zijn</li>
                <li>De beschrijving wordt straks opgedeeld in korte en lange beschrijving, dat is handig.</li>
                <li>De soort die je kiest bepaalt het plaatje dat erbij komt</li>
                <li><strong>Niet iedereen kan publiceren!</strong> Alleen de senaat/webcie kan een activiteit publiceren :)</li>
            </ul>
        </div>
    </div>
@endsection

@section('javascripts')
    @parent

    <script>
        $(document).ready(function() {
            var startTime = $('#start_time')[0];
            var $wholeDay = $('#whole_day');

            function toggleTimeBoxes() {
                startTime.disabled = $wholeDay[0].checked;
            }

            $wholeDay.change(toggleTimeBoxes);
            toggleTimeBoxes();
        });
    </script>
@stop