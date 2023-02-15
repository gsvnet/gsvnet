<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Foundation\Http\Middleware\EncryptCookies::class,
            \Illuminate\Foundation\Http\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Foundation\Http\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
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
        'auth' => \App\Http\Middleware\Authenticate::class,
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

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
