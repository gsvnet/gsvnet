@extends('layouts.admin')

@section('content')

    <div class="page-header">
        <h1>GSVnet van achter</h1>
    </div>
    <p>Welkom bij de achterkant van de website! Op basis van de commissies die je doet kun je hier de dingen wel of niet aanpassen.</p>

    <h3>Snelle dingetjes</h3>
    <p>Voor excelexperts</p>
    <p>
        <a href="{!! URL::action('Admin\UsersController@exportMembers') !!}" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Ledenbestand (csv)</a>
    </p>
    <p>
        <a href="{!! URL::action('Admin\MemberController@exportNewspaperRecipients') !!}" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> SIC-ontvangers (csv)</a>
    </p>
@stop