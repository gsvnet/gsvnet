<?php namespace GSV\Exceptions;

use Exception;
use GSVnet\Core\Exceptions\ValidationException;
use GSVnet\Core\Exceptions\ValueObjectValidationException;
use GSVnet\Permissions\NoPermissionException;
use GSVnet\Permissions\UserAccountNotApprovedException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
                abort(404);
                break;
            case UserAccountNotApprovedException::class:
                return response(view('errors.unauthorized'), 401);
                break;
            case ValidationException::class:
            case ValueObjectValidationException::class:
                return redirect()->back()->withInput()->withErrors($e->getErrors());
                break;
            case ModelNotFoundException::class:
                abort(404);
                break;
                
        }

        return parent::render($request, $e);
    }
}
