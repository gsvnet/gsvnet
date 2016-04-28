<?php namespace Malfonds;


use GSV\Http\ResponderTrait;
use GSVnet\Core\DispatchesJobs;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class CoreApiController extends Controller
{
    use ResponderTrait, DispatchesJobs, AuthorizesRequests;
}