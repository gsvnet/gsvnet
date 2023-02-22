@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1><a href="{!! $profile->present()->xsmallProfileImage !!}" title="Grote foto"><img src="{!! $profile->present()->xsmallProfileImage !!}" width="102" height="102" alt="Profielfoto"/></a> {{ $user->present()->fullName }}</h1>
    </div>

    @can('user.manage.password', $user)
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-pills">
                <li role="presentation">
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editPassword'], ['user' => $user->id]) }}">
                        <i class="fa fa-unlock-alt"></i> Wachtwoord wijzigen
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <hr>
    @endcan

    <div class="row">
        <div class="col-xs-12 col-md-8">

            @cannot('users.manage')
                <div class="alert alert-info" role="alert"><strong>Tip: Klopt er iets niet wat u zelf niet kunt wijzigen? Mail de abactis!</strong></div>
            @endcan

            {{-- Name --}}

            <h3>
                <i class="glyphicon glyphicon-user"></i>
                Naam
                @can('user.manage.name', $user)
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editName'], ['user' => $user->id]) }}">(wijzig)</a>
                @endcan
            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                    <tr>
                        <th>Initialen</th>
                        <td>{{$profile->initials}}</td>
                    </tr>

                    <tr>
                        <th>Naam</th>
                        <td>{{ $user->present()->fullName }}</td>
                    </tr>
                </tbody>
            </table>

            <h3>
                <i class="glyphicon glyphicon-comment"></i>
                Gebruikersnaam
                @can('users.manage')
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editUsername'], ['user' => $user->id]) }}">(wijzig)</a>
                @endcan

            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                <tr>
                    <th>Gebruikersnaam</th>
                    <td>{{ $user->username }}</td>
                </tr>
                </tbody>
            </table>

            {{-- Lid status --}}

            <h3>
                <i class="fa fa-flag"></i> Jaarverband &amp; Regio
            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                    <tr>
                        <th>Jaarverband</th>
                        <td>
                            @if($profile->yearGroup)
                                {{ $profile->yearGroup->present()->nameWithYear }}
                            @else
                                Onbekend
                            @endif
                            @can('users.manage', $user)
                                <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editYearGroup'], ['user' => $user->id]) }}">(wijzig)</a>
                            @endcan
                        </td>
                    </tr>
                    <tr>
                        <th>Regio</th>
                        <td>
                            {{ $profile->present()->regionName }} 
                            @can('users.manage', $user)
                                <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editRegion'], ['user' => $user->id]) }}">(wijzig)</a>
                            @endcan
                        </td>
                    </tr>
                    <tr>
                        <th>Lid-status</th>
                        <td>
                            {{ $user->present()->membershipType }}
                            @can('users.manage')
                                <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editMembershipStatus'], ['user' => $user->id]) }}">(wijzig)</a>
                            @endcan
                        </td>
                    </tr>
                    <tr>
                        <th>Geïnaugureerd op</th>
                        <td>
                            @if(is_null($profile->inauguration_date))
                                <span class="text-muted">Niet ingesteld</span>
                            @else
                                {{ $profile->present()->inaugurationDateExpressive() }}
                            @endif

                            @can('users.manage', $user)
                                <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editMembershipPeriod'], ['user' => $user->id]) }}">(wijzig)</a>
                            @endcan
                        </td>
                    </tr>
                    @if ($user->isFormerMember())
                    <tr>
                        <th>Bedankt op</th>
                        <td>
                            @if($profile->resignation_date instanceof Carbon\Carbon)
                                {{ $profile->resignation_date->resignationDateExpressive() }}
                            @else
                                <span class="text-muted">Niet ingesteld</span>
                            @endif

                            @can('users.manage', $user)
                                <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editMembershipPeriod'], ['user' => $user->id]) }}">(wijzig)</a>
                            @endcan
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

            {{-- Email --}}

            <h3>
                <i class="glyphicon glyphicon-envelope"></i>
                Email

                @can('user.manage.email', $user)
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editEmail'], ['user' => $user->id]) }}">(wijzig)</a>
                @endcan
            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                </tbody>
            </table>

            {{-- Contactgegevens --}}

            <h3>
                <i class="glyphicon glyphicon-home"></i>
                Contactgegevens

                @can('user.manage.address', $user)
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editContactDetails'], ['user' => $user->id]) }}">(wijzig)</a>
                @endcan
            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                <tr>
                    <th>Telefoon</th>
                    <td>{{ $profile->phone }}</td>
                </tr>
                <tr>
                    <th>Adres</th>
                    <td>{{ $profile->address }}</td>
                </tr>
                <tr>
                    <th>Postcode</th>
                    <td>{{ $profile->zip_code }}</td>
                </tr>
                <tr>
                    <th>Plaats</th>
                    <td>{{ $profile->town }}</td>
                </tr>
                <tr>
                    <th>Land</th>
                    <td>{{ $profile->country }}</td>
                </tr>
                </tbody>
            </table>

            @if ($user->isMember())
                {{-- SIC fysiek thuis ontvangen --}}

                <h3>
                    <i class="fa fa-newspaper-o"></i>
                    SIC thuis ontvangen

                    @can('user.manage.receive_newspaper', $user)
                        <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editNewspaper'], ['user' => $user->id]) }}">(wijzig)</a>
                    @endcan
                </h3>
                <table class='table table-striped table-hover' style="table-layout: fixed;">
                    <tbody>
                    <tr>
                        <th>SIC thuis ontvangen</th>
                        <td>{{ $profile->receive_newspaper ? 'Ja' : 'Nee' }}</td>
                    </tr>
                    </tbody>
                </table>
            @endif

            {{-- Profile picture --}}

            <h3>
                <i class="fa fa-camera"></i>
                Profielfoto

                @can('user.manage.photo', $user)
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editPhoto'], ['user' => $user->id]) }}">(wijzig)</a>
                @endcan
            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                <tr>
                    <th>Profielfoto</th>
                    <td>
                        @if (empty($profile->photo_path))
                            <span class="text-danger">Geen ingesteld</span>
                        @else
                            <img src="{{$profile->present()->xsmallProfileImage}}" width="102" height="102" alt="Profielfoto" />
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>

            {{-- Gender --}}

            <h3>
                <i class="fa fa-transgender"></i>
                Geslacht

                @can('user.manage.gender', $user)
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editGender'], ['user' => $user->id]) }}">(wijzig)</a>
                @endcan
            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                <tr>
                    <th>Geslacht</th>
                    <td>{{ $profile->present()->genderLocalized() }}</td>
                </tr>
                </tbody>
            </table>

            {{-- Birth date --}}

            <h3>
                <i class="glyphicon glyphicon-calendar"></i> 
                Geboortedatum

                @can('user.manage.birthday', $user)
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editBirthDay'], ['user' => $user->id]) }}">(wijzig)</a>
                @endcan
            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                <tr>
                    <th>Geboortedatum</th>
                    <td>{{ Carbon\Carbon::parse($profile->birthdate)->formatLocalized('%e %B %Y') }}</td>
                </tr>
                </tbody>
            </table>

            {{-- Study --}}

            <h3>
               <i class="fa fa-university"></i> Studie

                @can('user.manage.study', $user)
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editStudy'], ['user' => $user->id]) }}">(wijzig)</a>
                @endcan
            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                <tr>
                    <th>Studie</th>
                    <td>{{ $profile->study }}</td>
                </tr>
                <tr>
                    <th>Studentennummer</th>
                    <td>{{ $profile->student_number }}</td>
                </tr>
                </tbody>
            </table>

            <hr>

            {{-- Business --}}

            <h3>
                <i class="glyphicon glyphicon-briefcase"></i> 
                Werkgegevens

                @can('user.manage.business', $user)
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editBusiness'], ['user' => $user->id]) }}">(wijzig)</a>
                @endcan
            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                <tr>
                    <th>Bedrijf</th>
                    <td>{{ $profile->company }}</td>
                </tr>
                <tr>
                    <th>Functie</th>
                    <td>{{ $profile->profession }}</td>
                </tr>
                <tr>
                    <th>LinkedIn</th>
                    <td>{{ $profile->business_url }}</td>
                </tr>
                </tbody>
            </table>

            {{-- Parents --}}

            <h3>
               <i class="fa fa-users"></i> Gegevens ouders

                @can('user.manage.parents', $user)
                    <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editParentContactDetails'], ['user' => $user->id]) }}">(wijzig)</a>
                @endcan
            </h3>
            <table class='table table-striped table-hover' style="table-layout: fixed;">
                <tbody>
                <tr>
                    <th>Telefoon</th>
                    <td>{{ $profile->parent_phone }}</td>
                </tr>
                <tr>
                    <th>Emailadres</th>
                    <td>{{ $profile->parent_email }}</td>
                </tr>
                <tr>
                    <th>Adres</th>
                    <td>{{ $profile->parent_address }}</td>
                </tr>
                <tr>
                    <th>Postcode</th>
                    <td>{{ $profile->parent_zip_code }}</td>
                </tr>
                <tr>
                    <th>Plaats</th>
                    <td>{{ $profile->parent_town }}</td>
                </tr>
                </tbody>
            </table>


            @can('users.manage')
                <hr>
                <p><strong>In leven</strong> <a href="{{ action([\App\Http\Controllers\Admin\MemberController::class, 'editAlive'], ['user' => $user->id]) }}">(wijzig)</a></p>
                <p>{{$profile->alive ? 'Ja' : 'Nee'}}</p>
            @endcan

            @can('users.manage')
                <hr>
                {!! Former::inline_open()
                    ->action(action([\App\Http\Controllers\Admin\MemberController::class, 'setForget'], ['user' => $user->id]))
                    ->method('GET') !!}

                <button type='submit' class='btn btn-primary'>
                    <i class="glyphicon glyphicon-trash"></i> Gegevens vergeten (conform AVG)
                </button>

                {!! Former::close() !!}
            @endcan

            <hr>

            @if ($committees->count() > 0)
                <h3>Commissiewerk</h3>
                <ul>
                    @foreach ($committees as $committee)
                        <li>
                            <a href="{{action([\App\Http\Controllers\Admin\CommitteeController::class, 'show'], ['commissy' => $committee->id])}}">{{ $committee->name }}: {{$committee->present()->from_to }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-xs-12 col-md-4">
            <h2>
                <i class="fa fa-tree"></i> GSV-familie

                @can('users.manage')
                    <a href="{{ action([\App\Http\Controllers\Admin\FamilyController::class, 'index'], ['gebruiker' => $user->id]) }}">(wijzig)</a>
                @endcan
            </h2>
            <h3>Papa of mama</h3>
            @forelse($user->parents as $parent)
                {{$parent->present()->fullName() }}
            @empty
                <span class="text-danger">Geen vader of moeder</span>
            @endforelse

            <h3>Kinderen</h3>
            @forelse($user->children as $child)
                {{$child->present()->fullName() }}
            @empty
                <span class="text-muted">Geen kinderen</span>
            @endforelse

            <h2>Laatste veranderingen</h2>
            <ul class="list-group">
                @forelse($user->profileChanges()->take(10)->orderBy('at', 'DESC')->get() as $change)
                    <li class="list-group-item">
                        <h4 class="list-group-item-heading">{{ $change->present()->actionName() }}</h4>
                        <p class="list-group-item-text">{{ $change->at->diffForHumans() }}</p>
                    </li>
                @empty
                    <li class="list-group-item">Niks recent veranderd</li>
                @endforelse
            </ul>
        </div>
    </div>
@stop
