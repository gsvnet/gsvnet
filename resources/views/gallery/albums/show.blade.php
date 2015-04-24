@extends('layouts.default')

@section('title', $album->name)
@section('description', $album->description)
@section('body-id', 'album-page')

<?php $repeatsAfter = 10; ?>

@section('content')
    <div class="column-holder" role="main">
        <h1>{{ $album->name }}</h1>
        <p class="delta">{{ $album->description }}</p>

        <div class="photos">
            @for($i=0; $i<count($photos); $i++)
                @if($i==2)
                    <div class="photo-tile tile-number-2 word-lid-tile">
                        <a href="{{ URL::action('MemberController@becomeMember')  }}" class="full-tile-link" title="Word lid van de GSV Groningen">
                            Word lid en maak dit mee!
                        </a>
                    </div>
                @else
                    @include('gallery._album', ['album' => $photos[$i], 'description' => $photos[$i]->name, 'wide' => $i % $repeatsAfter == 4 || $i % $repeatsAfter == 8, 'class' => 'tile-number-' . ($i % $repeatsAfter)])
                @endif
            @endfor
        </div>

        {!! $photos->render() !!}
    </div>
@stop