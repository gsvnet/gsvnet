{{ Former::text('title')->required()->autofocus()->label('Titel') }}
{{ Former::text('meta_description')->required()->label('Korte beschrijving')->help('Het liefst een regel van gemiddelde lengte die de hele lading van de activiteit dekt') }}
{{ Former::textarea('description')->required()->label('Uitgebreide beschrijving')->help('De uitgebreide beschrijving mag meerdere regels lang zijn') }}
{{ Former::text('location')->label('Locatie')->help('Mag je gewoon leeg laten') }}
{{ Former::select('type')->options(Config::get('gsvnet.eventTypesPresented', []))->label('Soort')->required()->help('Dit is voor het plaatje') }}
{{ Former::date('start_date')->required()->label('Startdatum') }}
{{ Former::checkbox('whole_day')->value('1')->text('Begintijd doet er niet toe')->label(null) }}
{{ Former::time('start_time')->label('Starttijd')->help('Een starttijd is alleen verplicht als je het het vakje hierboven niet is aangevinkt') }}
{{ Former::date('end_date')->required()->label('Einddatum')->help('Als de activiteit maar een dag duurt, moet je dezelfde datum invullen als de startdatum') }}

{{ Former::checkbox('public')->text('Maak activiteit openbaar (voor externen)')->label(null) }}

@if (Permission::has('events.publish'))
    {{ Former::checkbox('published')->text('Publiceer activiteit (laat hem uberhaupt zien)')->label(null) }}
@endif