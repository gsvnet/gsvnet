<?php

namespace App\Exceptions;

use App\Helpers\Permissions\NoPermissionException;
use App\Helpers\Permissions\UserAccountNotApprovedException;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
        \App\Helpers\Permissions\UserAccountNotApprovedException::class,
        \App\Helpers\Permissions\NoPermissionException::class,
        ValueObject\Illuminate\Validation\ValidationException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Throwable $e)
    {
        Bugsnag::notifyException($e);
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $e)
    {
        switch (get_class($e)) {
            case \Illuminate\Auth\Access\AuthorizationException::class:
            case NoPermissionException::class:
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(null, Response::HTTP_UNAUTHORIZED);
                } else {
                    abort(404);
                }
                break;
            case UserAccountNotApprovedException::class:
                return response(view('errors.unauthorized'), 401);
                break;
            case \Illuminate\Validation\ValidationException::class:
            case ValueObject\Illuminate\Validation\ValidationException::class:
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json($e->getErrors(), Response::HTTP_BAD_REQUEST);
                } else {
                    return redirect()->back()->withInput()->withErrors($e->getErrors());
                }
                break;
            case \Illuminate\Database\Eloquent\ModelNotFoundException::class:
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(null, Response::HTTP_NOT_FOUND);
                } else {
                    abort(404);
                }
                break;

        }

        return parent::render($request, $e);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $e
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $e)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        } else {
            return redirect()->guest('login');
        }
    }
}
