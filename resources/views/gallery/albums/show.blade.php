@extends('layouts.default')

@section('title', $album->name)
@section('description', $album->description)
@section('body-id', 'album-page')

<?php
    // Dit moet even mooier gedaan worden hoor
    $repeatsAfter = 10;
?>

@section('content')
    <div class="column-holder" role="main">
        <h1>{{ $album->name }}</h1>
        <p class="delta">{{ $album->description }}</p>

        <div class="photos">
            @for($i=0; $i<count($photos); $i++)
                @include('gallery._album', array('album' => $photos[$i], 'description' => $photos[$i]->name, 'wide' => $i % $repeatsAfter == 4 || $i % $repeatsAfter == 8, 'class' => 'tile-number-' . ($i % $repeatsAfter)))
            @endfor
        </div>

        {!! $photos->render() !!}
    </div>
@stop