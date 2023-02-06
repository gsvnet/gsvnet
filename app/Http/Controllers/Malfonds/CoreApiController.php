<?php namespace Malfonds;


use App\Http\ResponderTrait;
use App\Helpers\Core\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class CoreApiController extends Controller
{
    use ResponderTrait, DispatchesJobs, AuthorizesRequests;
}