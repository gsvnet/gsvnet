@extends('layouts.default')

@section('javascripts')
    @parent

    @if(Auth::check())
        <script async src="/build-javascripts/forum.js?v=1.0.7"></script>
    @endif
@endsection