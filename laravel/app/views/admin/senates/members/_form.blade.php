<h3>Leden toevoegen</h3>
<ul class='list-group'>
    @foreach($users as $user)
        @include('admin.committees._member')
    @endforeach
</ul>