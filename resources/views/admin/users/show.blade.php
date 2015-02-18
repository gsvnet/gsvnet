@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>{{ $user->present()->fullName }} <a href="{{ URL::action('Admin\UsersController@edit', $user->id) }}" alt="Bewerk {{ $user->fullName }}" class='btn btn-default'><i class="fa fa-pencil"></i> Account bewerken</a></h1>
    </div>

    <dl class="dl-horizontal">
        <dt>Naam</dt>
        <dd>{{ $user->present()->fullName }}</dd>

        <dt>Email</dt>
        <dd>{{ $user->email }}</dd>

        <dt>Type</dt>
        <dd>{{ $user->type }}</dd>
    </dl>

    @if($profile)
        <div class="page-header">
            <h2><img src="{!! $profile->present()->xsmallProfileImage !!}" width="102" height="102" alt="Profielfoto"/> GSV-profiel</h2>
        </div>

        <dl class="dl-horizontal">
            @if ($profile->yearGroup)
                <dt>Jaarverband</dt>
                <dd>{{ $profile->yearGroup->name }}</dd>
            @endif

            @foreach ($profile->getAttributes() as $key => $value)
                {{-- Only show attribute if value is set --}}
                <dt>{{ $key }}</dt>
                <dd>{{ $value }} &nbsp;</dd>
            @endforeach
        </dl>
    @endif

    @if ($committees->count() > 0)
        <div class="page-header">
            <h2>Commissies</h2>
            <ul>
                @foreach ($committees as $committee)
                    <li>{{ $committee->name }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@stop
