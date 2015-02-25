@extends('layouts.admin')

@section('content')
    <div class="page-header">
        @if($profile)
            <h1><img src="{!! $profile->present()->xsmallProfileImage !!}" width="102" height="102" alt="Profielfoto"/> {{ $user->present()->fullName }}</h1>
        @else
            <h1>{!! $user->present()->avatar(102) !!} {{ $user->present()->fullName }}</h1>
        @endif

        <a href="{{ URL::action('Admin\UsersController@edit', $user->id) }}" alt="Bewerk {{ $user->fullName }}" class='btn btn-default'><i class="fa fa-pencil"></i> Account bewerken</a>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-6">
            <h2>Algemene gegevens</h2>
            <dl>
                <dt>Naam</dt>
                <dd>{{ $user->present()->fullName }}</dd>

                <dt>Email</dt>
                <dd>{{ $user->email }}</dd>

                <dt>Type</dt>
                <dd>{{ $user->present()->membershipType }}</dd>
            </dl>
        </div>
        <div class="col-xs-12 col-md-6">
            @if($profile)
                <h2>GSV-profiel</h2>

                <dl>
                    @if($user->type == GSVnet\Users\User::FORMERMEMBER)
                        <dt>Reunist?</dt>
                        <dd>{{$profile->reunist == 0 ? 'Nee' : 'Ja'}}</dd>
                    @endif

                    <dt>Initialen</dt>
                    <dd>{{$profile->initials}}</dd>

                    <dt>Geslacht</dt>
                    <dd>{{$profile->present()->genderLocalized}}</dd>

                    <dt>Geboortedatum</dt>
                    <dd>{{Carbon\Carbon::parse($profile->birthdate)->formatLocalized('%e %B %Y')}}</dd>

                    @if ($profile->yearGroup)
                        <dt>Jaarverband</dt>
                        <dd>{{ $profile->yearGroup->present()->nameWithYear }}</dd>
                    @endif

                    <dt>Regio</dt>
                    <dd>{{$profile->present()->regionName}}</dd>

                    <dt>Adres</dt>
                    <dd>
                        <address>
                            {{$profile->address}}<br/>
                            {{$profile->zip_code}} {{$profile->town}}
                        </address>
                    </dd>

                    <dt>Kerk</dt>
                    <dd>{{$profile->church}}</dd>

                    <dt>Studie</dt>
                    <dd>{{$profile->study}}</dd>

                    <dt>Studentnummer</dt>
                    <dd>{{$profile->student_number}}</dd>

                    <dt>Adres ouders</dt>
                    <dd>
                        <address>
                            {{$profile->parent_address}}<br/>
                            {{$profile->parent_zip_code}} {{$profile->parent_town}}
                        </address>
                    </dd>

                    <dt>Telefoon ouders</dt>
                    <dd>{{$profile->parent_phone}}</dd>
                </dl>
            @endif
        </div>
    </div>

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
