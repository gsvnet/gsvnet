{!! Former::text('title')->required()->autofocus()->label('Titel') !!}
{!! Former::text('meta_description')->required()->label('Korte beschrijving')->help('Het liefst een regel van gemiddelde lengte die de hele lading van de activiteit dekt') !!}
{!! Former::textarea('description')->rows(6)->required()->label('Uitgebreide beschrijving')->help('De uitgebreide beschrijving mag meerdere regels lang zijn') !!}
{!! Former::text('location')->label('Locatie')->help('Mag je gewoon leeg laten') !!}
{!! Former::select('type')->options(Config::get('gsvnet.eventTypesPresented', []))->label('Soort')->required()->help('Dit is voor het plaatje') !!}
{!! Former::text('start_date')->class('form-control datepicker')->required()->label('Startdatum')->dataValue(isset($event) ? $event->start_date : '') !!}
{!! Former::checkbox('whole_day')->value('1')->text('Begintijd doet er niet toe')->label(null) !!}
{!! Former::text('start_time')->class('form-control timepicker')->label('Starttijd')->help('uu:mm')->dataValue(isset($event) ? $event->start_time : '') !!}
{!! Former::text('end_date')->class('form-control datepicker')->required()->dataValue(isset($event) ? $event->end_date : '')->label('Einddatum')->help('Als de activiteit maar een dag duurt, moet je dezelfde datum invullen als de startdatum') !!}

{!! Former::checkbox('public')->text('Maak activiteit openbaar (voor externen)')->label(null) !!}

@if (Permission::has('events.publish'))
    {!! Former::checkbox('published')->text('Publiceer activiteit (laat hem uberhaupt zien)')->label(null) !!}
@endif