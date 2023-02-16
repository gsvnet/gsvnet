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
            @for($i=0, $j=0; $i<count($photos); $i++, $j++)
                @if($i==2)
                    <a href="{{ URL::action([\App\Http\Controllers\MemberController::class, 'index'])  }}" class="photo-tile tile-number-2 word-lid-tile">
                        <div class="spacer">
                            <span class="full-tile-link" title="Word lid van de GSV Groningen">
                                Meld je nu aan!
                            </span>
                        </div>
                    </a>
                    <?php $j++ ?>
                @endif

                @include('gallery._album', ['album' => $photos[$i], 'description' => $photos[$i]->name, 'wide' => $j % $repeatsAfter == 4 || $j % $repeatsAfter == 8, 'class' => 'tile-number-' . ($j % $repeatsAfter)])
            @endfor
        </div>

        {!! $photos->render() !!}
    </div>
@stop