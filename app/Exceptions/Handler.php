<?php namespace GSV\Exceptions;

use Exception;
use GSVnet\Core\Exceptions\ValidationException;
use GSVnet\Permissions\NoPermissionException;
use GSVnet\Permissions\UserAccountNotApprovedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
    {
        switch (get_class($e))
        {
            case NoPermissionException::class:
                $data = [
                    'title' => 'Helaas, u heeft niet voldoende rechten om deze pagina te bekijken.',
                    'description' => '',
                    'keywords' => ''
                ];

                return response(view('errors.unauthorized')->with($data), 401);
                break;
            case UserAccountNotApprovedException::class:
                $data = [
                    'title' => 'Helaas, u heeft niet voldoende rechten om deze pagina te bekijken.',
                    'description' => '',
                    'keywords' => ''
                ];

                return response(view('errors.unauthorized')->with($data), 401);
                break;
            case ValidationException::class:
                return redirect()->back()->withInput()->withErrors($e->getErrors());
                break;
            case ModelNotFoundException::class:
                abort(404);
                break;
        }

        return parent::render($request, $e);
    }
}
