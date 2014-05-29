{{ Former::text('name')->autofocus()->label('Naam') }}
{{ Former::date('start_date')->label('Van') }}
{{ Former::date('end_date')->label('Tot') }}
{{ Former::textarea('body')->rows(10)->label('Beschrijving (opmaak gaat met Markdown)') }}