<label>
<li class='list-group-item'>
        <input type="checkbox" value="{{{ $user->id }}}" name="users[{{{ $user->id }}}]">
        {{{ $user->present()->fullName }}}
</li>
</label>