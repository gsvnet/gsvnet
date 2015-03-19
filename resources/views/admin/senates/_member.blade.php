<li class="list-group-item">
<label>
        <input type="checkbox" value="{{ $user->id }}" name="members[{{ $user->id }}]"
        @if ( $members->contains($user->id))
            checked="checked"
        @endif
        >
        {{ $user->present()->fullName }}
</label>
</li>