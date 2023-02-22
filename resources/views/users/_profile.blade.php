<li class="user-profile-item">
    <div class="profile-image">
        <img src="{!! $member->present()->xsmallProfileImage !!}" width="102" height="102" alt="Profielfoto" />
    </div>
    <div class="user-details">
        <h3>
            <a href="{{route('showUser', $member->user->id)}}">{{ $member->user->present()->fullName }}</a>
        </h3>
        <ul class="user-details-list">
            <li>
                <i class="fa fa-share"></i>
                {!! HTML::mailto($member->user->email) !!}
            </li>
            <li class="phone">
                <i class="fa fa-phone"></i>
                <a href="tel:{{$member->phone}}" title="Bel {{$member->user->fullName}}">{{$member->phone}}</a>
            </li>
            <li>
                <span class="dot-after">{{$member->present()->yearGroupName}}</span>
                {{$member->present()->regionName}}
            </li>
        </ul>
    </div>
</li>