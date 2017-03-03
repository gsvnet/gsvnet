{!! Former::text('name')->autofocus()->label('Naam') !!}
{!! Former::input('start_date')->class('form-control datepicker')->dataValue(isset($senate) ? $senate->start_date : '')->label('Van') !!}
{!! Former::input('end_date')->class('form-control datepicker')->dataValue(isset($senate) ? $senate->end_date : '')->label('Tot') !!}
{!! Former::textarea('body')->rows(10)->label('Beschrijving (opmaak gaat met Markdown)') !!}