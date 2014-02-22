{{ Former::text('title')->required()->autofocus() }}
{{ Former::textarea('description')->required() }}
{{ Former::text('location') }}
{{ Former::checkbox('whole_day')->value('1') }}
{{ Former::date('start_date')->required() }}
{{ Former::time('start_time')->required() }}
{{ Former::date('end_date')->required() }}
{{ Former::time('end_time')->required() }}

{{ Former::checkbox('public')->text('Maak activiteit pulbiek')->label(null) }}

@if (Permission::has('events.publish'))
    {{ Former::checkbox('published')->text('Publiceer activiteit')->label(null) }}
@endif