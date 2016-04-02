@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1><a href="{{ action('MemberController@showPhoto', $profile->id) }}" title="Grote foto"><img src="{!! $profile->present()->xsmallProfileImage !!}" width="102" height="102" alt="Profielfoto"/></a> {{ $user->present()->fullName }}</h1>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h2>Persoonlijke gegevens</h2>
            <ul class="nav nav-pills">
                @can('user.manage.name', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editName', $user->id) }}">
                        <i class="glyphicon glyphicon-user"></i> Naam
                    </a>
                </li>
                @endcan
                @can('user.manage.address', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editContactDetails', $user->id) }}">
                        <i class="glyphicon glyphicon-home"></i> Contactgegevens
                    </a>
                </li>
                @endcan
                @can('user.manage.photo', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editPhoto', $user->id) }}">
                        <i class="fa fa-camera"></i> Foto
                    </a>
                </li>
                @endcan
                @can('user.manage.gender', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editGender', $user->id) }}">
                        <i class="fa fa-transgender"></i> Geslacht
                    </a>
                </li>
                @endcan
                @can('user.manage.birthday', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editBirthDay', $user->id) }}">
                        <i class="glyphicon glyphicon-calendar"></i> Geboortedatum
                    </a>
                </li>
                @endcan
                @can('user.manage.business', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editBusiness', $user->id) }}">
                        <i class="glyphicon glyphicon-briefcase"></i> Werkgegevens
                    </a>
                </li>
                @endcan
                @can('user.manage.study', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editStudy', $user->id) }}">
                        <i class="fa fa-university"></i> Studie
                    </a>
                </li>
                @endcan
                @can('user.manage.parents', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editParentContactDetails', $user->id) }}">
                        <i class="fa fa-users"></i> Ouders
                    </a>
                </li>
                @endcan
                @can('user.manage.email', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editEmail', $user->id) }}">
                        <i class="glyphicon glyphicon-envelope"></i> Emailadres
                    </a>
                </li>
                @endcan
                @can('user.manage.password', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editPassword', $user->id) }}">
                        <i class="fa fa-unlock-alt"></i> Wachtwoord
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h2>GSV</h2>
            <ul class="nav nav-pills">
                @can('users.manage')
                <li role="presentation">
                    <a href="{{ action('Admin\FamilyController@index', $user->id) }}">
                        <i class="fa fa-tree"></i> GSV-stamboom
                    </a>
                </li>
                @endcan
                @can('users.manage')
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editYearGroup', $user->id) }}">
                        <i class="fa fa-flag"></i> Jaarverband
                    </a>
                </li>
                @endcan
                @can('users.manage')
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editMembershipPeriod', $user->id) }}">
                        <i class="fa fa-hourglass-end"></i> Periode van lidmaatschap
                    </a>
                </li>
                @endcan
                @can('users.manage')
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editRegion', $user->id) }}">
                        <i class="fa fa-sitemap"></i> Regio
                    </a>
                </li>
                @endcan
                @can('users.manage', $user)
                <li role="presentation">
                    <a href="{{ action('Admin\MemberController@editAlumniStatus', $user->id) }}">
                        <i class="fa fa-eur"></i> Reüniststatus
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-xs-12 col-md-8">
            <h2>Overzicht</h2>
            <table class='table table-striped table-hover sort-table'>
                <tbody>

                    <tr>
                        <th>Initialen</th>
                        <td>{{$profile->initials}}</td>
                    </tr>

                    <tr>
                        <th>Naam</th>
                        <td>{{ $user->present()->fullName }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                        <th>Type</th>
                        <td>{{ $user->present()->membershipType }}</td>
                    </tr>

                    @if($user->type == GSVnet\Users\User::FORMERMEMBER)
                    <tr>
                        <th>Reunist?</th>
                        <td>{{$profile->reunist == 0 ? 'Nee' : 'Ja'}}</td>
                    </tr>
                    @endif

                    <tr>
                        <th>Geslacht</th>
                        <td>{{$profile->present()->genderLocalized}}</td>
                    </tr>

                    <tr>
                        <th>Geboortedatum</th>
                        <td>{{Carbon\Carbon::parse($profile->birthdate)->formatLocalized('%e %B %Y')}}</td>
                    </tr>

                    <tr>
                        <th>Jaarverband</th>
                        <td>{{ $profile->yearGroup->present()->nameWithYear }}</td>
                    </tr>

                    <tr>
                        <th>Regio</th>
                        <td>{{$profile->present()->regionName}}</td>
                    </tr>

                    <tr>
                        <th>Adres</th>
                        <td>
                            <address>
                                {{$profile->address}}<br/>
                                {{$profile->zip_code}} {{$profile->town}}
                            </address>
                        </td> 
                    </tr>

                    <tr>
                        <th>Kerk</th>
                        <td>{{$profile->church}}</td>
                    </tr>

                    <tr>
                        <th>Studie</th>
                        <td>{{$profile->study}}</td>
                    </tr>

                    <tr>
                        <th>Studentnummer</th>
                        <td>{{$profile->student_number}}</td>
                    </tr>

                    <tr>
                        <th>Adres ouders</th>
                        <td><address>
                            {{$profile->parent_address}}<br/>
                            {{$profile->parent_zip_code}} {{$profile->parent_town}}
                        </address>
                           
                        </td> 
                    </tr>

                    <tr>
                        <th>Telefoon ouders</th>
                        <td>{{$profile->parent_phone}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    @if ($committees->count() > 0)
        <div class="page-header">
            <h2>Commissies</h2>
            <ul>
                @foreach ($committees as $committee)
                    <li><a href="{{action('Admin\CommitteeController@show', ['id' => $committee->id])}}">{{ $committee->name }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif
@stop
