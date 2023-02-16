<tr class="{{ $user->isFormerMember() ? 'stats--former-member' : '' }}">
	<td>{{ $index }}</td>
	<td><a href="{{URL::action([\App\Http\Controllers\UserController::class, 'showUser'], ['id' => $user->id])}}">{{$user->present()->fullname}}</a></td>
	<td>{{ $user->num }}</td>
</tr>