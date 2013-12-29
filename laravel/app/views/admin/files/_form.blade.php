{{ Former::text('name')->required()->autofocus() }}

{{ Former::file('file')->required()->help("") }}

{{-- Former::text('labels') --}}

{{ Former::select('labels')->fromQuery($labels, 'name', 'id')->multiple(true) }}

<h3>Labels</h3>
@foreach ($labels as $label)
<div class="checkbox">
  <label>
    <input type="checkbox" value="{{{ $label->name }}}" name="{{{ $label->id }}}">
    {{{ $label->name }}}
  </label>
</div>
@endforeach



<hr>
