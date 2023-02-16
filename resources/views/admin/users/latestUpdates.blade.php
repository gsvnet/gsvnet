@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1>Laatste updates</h1>
    </div>

    <div class="row">
        <div class="col-xs-12 col-md-9">
            @if(empty($changes))
                <p>Nog niks</p>
            @else
                <div class="table-responsive">
                    <table class='table table-striped table-hover sort-table'>
                        <thead>
                        <tr>
                            <th>Wanneer</th>
                            <th>Wie</th>
                            <th>Wat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($changes as $change)
                            <tr>
                                <td class="text-muted"><time title="{{$change->at}}">{{ $change->at->diffForHumans() }}</time></td>
                                <td>
                                    <a href="{{ action([\App\Http\Controllers\Admin\UsersController::class, 'show'], $change->user->id) }}" title="{{ $change->user->present()->fullName }}">
                                        {{ $change->user->present()->fullName() }}
                                    </a>
                                </td>

                                <td>{{ $change->present()->actionName() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    {!! $changes->render() !!}
                </div>
            @endif
        </div>
    </div>
@stop
