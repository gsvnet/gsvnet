<div>{{ Former::text('name')->required()->autofocus() }}</div>
<div>
    {{ Former::file('photo')->accept('image') }}
</div>