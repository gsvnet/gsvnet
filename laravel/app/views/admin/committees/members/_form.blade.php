
{{-- Former::text('name')->autofocus() --}}

<ul class='list-group'>
    @foreach ($users as $user)
    <li class='list-group-item'>
        <button class="btn btn-sm btn-success">
            <i class="glyphicon glyphicon-plus"></i>
        </button>
        {{{ $user->full_name }}}
    </li>
    @endforeach

</ul>
