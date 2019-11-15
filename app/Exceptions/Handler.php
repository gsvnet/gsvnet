<?php namespace GSV\Exceptions;

use Exception;
use GSVnet\Core\Exceptions\ValidationException;
use GSVnet\Core\Exceptions\ValueObjectValidationException;
use GSVnet\Core\Exceptions\CSPException;
use GSVnet\Permissions\NoPermissionException;
use GSVnet\Permissions\UserAccountNotApprovedException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Bugsnag\BugsnagLaravel\BugsnagExceptionHandler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        UserAccountNotApprovedException::class,
        NoPermissionException::class,
        ValueObjectValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        switch (get_class($e)) {
            case AuthorizationException::class:
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
            case ValidationException::class:
            case ValueObjectValidationException::class:
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json($e->getErrors(), Response::HTTP_BAD_REQUEST);
                } else {
                    return redirect()->back()->withInput()->withErrors($e->getErrors());
                }
                break;
            case ModelNotFoundException::class:
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(null, Response::HTTP_NOT_FOUND);
                } else {
                    abort(404);
                }
                break;
            case CSPException::class:
                return response(view('errors.cspexception'));

        }

        return parent::render($request, $e);
    }
}
