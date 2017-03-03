{!! Former::text('name')->label('Naam') !!}
{!! Former::text('unique_name')->label('Unieke slug (kleine letters, geen spaties)')->help('Bijvoorbeeld: regiocommissie-regio-2') !!}
{!! Former::textarea('description')->label('Beschrijving') !!}
{!! Former::checkbox('public')->text('Maak commissie zichtbaar in het openbare commissieoverzicht')->label(null) !!}