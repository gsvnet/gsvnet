<?php namespace Malfonds;


use GSV\Http\ResponderTrait;
use GSV\Helpers\Core\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class CoreApiController extends Controller
{
    use ResponderTrait, DispatchesJobs, AuthorizesRequests;
}