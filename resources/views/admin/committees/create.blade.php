<section class="create-committee">
    <h2><i class="fa fa-plus"></i> Commissie toevoegen</h2>

    {!! Former::vertical_open()
        ->action(action('Admin\CommitteeController@store'))
        ->method('POST')
        ->class('add-form') !!}

        @include('admin.committees._form')

        <button type='submit' class='btn btn-success'>
            <i class="fa fa-check"></i> Toevoegen
        </button>

    {!! Former::close() !!}

</section>