<h2><a href="{{ URL::action([\App\Http\Controllers\AboutController::class, 'showSenates']) }}" title="Alle senaten">Senaten</a></h2>
<div id="senates">
    @if(count($senates) > 0)
    <ul id="senates-list" class="list secondary-menu to-select-box">
        @foreach($senates as $senate)
            <li class="senate"><a href="{{{URL::action([\App\Http\Controllers\AboutController::class, 'showSenate'], array($senate->id))}}}">{{{$senate->present()->nameWithYear}}}</a></li>
        @endforeach
    </ul>
    @endif
</div>