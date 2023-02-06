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
        CheckForMaintenanceMode::class,
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        ShareErrorsFromSession::class,
        OnlineUserCounter::class,
        FrameGuard::class,
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
        'tokenAuth' => ApiAuthenticated::class,
        'guest' => RedirectIfAuthenticated::class,
        'approved' => AccountNotApproved::class,
        'can' => MustHavePermission::class,
        'has' => MustHavePermission::class,
        'checkDate' => ValidEventDate::class,
        'notYetMember' => CanBecomeMember::class,
        'loginViaToken' => LoginViaToken::class,
    ];
}
