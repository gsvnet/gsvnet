<?php namespace GSV\Http;

use GSV\Http\Middleware\AccountNotApproved;
use GSV\Http\Middleware\Authenticate;
use GSV\Http\Middleware\CanBecomeMember;
use GSV\Http\Middleware\MustHavePermission;
use GSV\Http\Middleware\OnlineUserCounter;
use GSV\Http\Middleware\RedirectIfAuthenticated;
use GSV\Http\Middleware\ValidEventDate;
use GSV\Http\Middleware\VerifyCsrfToken;
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
        CheckForMaintenanceMode::class,
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        ShareErrorsFromSession::class,
        OnlineUserCounter::class
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'csrf' => VerifyCsrfToken::class,
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'guest' => RedirectIfAuthenticated::class,
        'approved' => AccountNotApproved::class,
        'can' => MustHavePermission::class,
        'has' => MustHavePermission::class,
        'checkDate' => ValidEventDate::class,
        'notYetMember' => CanBecomeMember::class
    ];
}
