@extends('layouts.admin')

@section('content')
    {!! Former::inline_open()
        ->action(action('Admin\PhotoController@destroy', [$photo->album_id, $photo->id]))
        ->method('DELETE') !!}
        <button type='submit' class='btn btn-danger'>
            <i class="glyphicon glyphicon-trash"></i> Verwijderen
        </button>

    {!! Former::close() !!}

    <div class="page-header">
        <h1>{{ $photo->name }} <small>uit <a href="{{ URL::action('Admin\AlbumController@show', $photo->album_id) }}" alt="Bewerk {{{ $photo->album->name }}}">{{{ $photo->album->name }}}</a></small></h1>
    </div>

    <h3>Kleine foto</h3>
    <div class="thumbnail">
        <img src="{{ $photo->small_image_url }}" alt="{{ $photo->name }}" style='max-width: 100%;'>
    </div>

    <div class="panel panel-default" id='edit'>
        <div class="panel-heading add-item">
            <h4 class="panel-title"><i class="fa fa-pencil"></i> Foto bewerken <span class="caret"></span></h4>
        </div>
        {!! Former::open_vertical_for_files()
            ->action(action('Admin\PhotoController@update', [$photo->album_id, $photo->id]))
            ->method('PUT')
            ->class('panel-body add-form') !!}

            {!! Former::populate($photo) !!}

            <h2>Foto bewerken</h2>
            @include('admin.photos._form')

            <button type='submit' class='btn btn-success'>
                <i class="fa fa-check"></i> Opslaan
            </button>

        {!! Former::close() !!}
    </div>
@stop

@section('javascripts')
    @parent
    <script>
        $(document).ready(function() {
            $('.add-item').on('click', function () {
                $('.add-form').toggle('fast');
            });
            // Hide success message after 2.5 seconds
            $('.alert.alert-success').delay(2500).slideUp(500);

            $('.btn-danger').click( function() {
                return confirm('Zeker weten?');
            });
        });

    </script>
@stop
