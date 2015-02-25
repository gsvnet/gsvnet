@extends('layouts.admin')

@section('content')
    <h1>Administratie</h1>

    <h2>Download de lijst met leden of oud-leden</h2>
    <p>
        <a href="{!! URL::action('Admin\UsersController@exportMembers') !!}" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Exporteer leden</a>
        <a href="{!! URL::action('Admin\UsersController@exportFormerMembers') !!}" class="btn btn-sm btn-default"><i class="fa fa-download"></i> Exporteer oud-leden</a>
    </p>
@stop