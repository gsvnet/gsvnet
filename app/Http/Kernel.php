<?php

namespace App\Http;

use App\Http\Middleware\AccountNotApproved;
use App\Http\Middleware\ApiAuthenticated;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CanBecomeMember;
use App\Http\Middleware\FrameGuard;
use App\Http\Middleware\LoginViaToken;
use App\Http\Middleware\MustHavePermission;
use App\Http\Middleware\OnlineUserCounter;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\ValidEventDate;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
            \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Foundation\Http\Middleware\EncryptCookies::class,
            \Illuminate\Foundation\Http\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Foundation\Http\Middleware\StartSession::class,
            \Illuminate\Foundation\Http\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\OnlineUserCounter::class,
            \App\Http\Middleware\FrameGuard::class,        
        ],

        'api' => [

        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'csrf' => \App\Http\Middleware\VerifyCsrfToken::class,
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'tokenAuth' => \App\Http\Middleware\ApiAuthenticated::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'approved' => \App\Http\Middleware\AccountNotApproved::class,
        'has' => \App\Http\Middleware\MustHavePermission::class,
        'checkDate' => \App\Http\Middleware\ValidEventDate::class,
        'notYetMember' => \App\Http\Middleware\CanBecomeMember::class,
        'loginViaToken' => \App\Http\Middleware\LoginViaToken::class,
    ];
}
