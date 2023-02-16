<div class="has-header">
    <div id="register-form" class="column-holder">
        {!! Former::open()->action(URL::action([\App\Http\Controllers\RegisterController::class, 'create'])) !!}
            @include('partials._register')
        {!!Former::close()!!}
    </div>
</div>