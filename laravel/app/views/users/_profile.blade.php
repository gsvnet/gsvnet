<li class="user-profile-item">
    <div class="profile-image">
        {{ $member->xsmallProfileImage }}
    </div>
    <div class="user-details">
        <h3>
            {{ link_to_action('UserController@showUser', $member->user->full_name, [$member->id], ['class' => 'search-users']) }}
        </h3>
        <ul class="user-details-list">
            <li>
                <i class="fa fa-share"></i>
                {{ HTML::mailto($member->user->email) }}
            </li>
            <li class="phone">
                <i class="fa fa-phone"></i>
                <a href="tel:{{{$member->phone}}}" title="Bel {{{$member->user->full_name}}}">{{{$member->phone}}}</a>
            </li>
            <li>
                <span class="dot-after">{{{$member->yearGroup->name or 'Geen jaarverband'}}}</span>
                Regio {{{$member->region}}}
            </li>
        </ul>
    </div>
</li>