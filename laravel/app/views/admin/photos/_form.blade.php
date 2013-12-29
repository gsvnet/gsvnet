{{ Former::text('name')->autofocus() }}

{{ Former::file('photo')->required()->accept('image')->help('Een afbeelding met een minimale dimensie van 634 x 308 wordt aangeraden.') }}
