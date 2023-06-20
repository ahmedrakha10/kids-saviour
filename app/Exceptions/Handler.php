<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */

    public function register()
    {
//        $this->renderable(function (\Spatie\Permission\Exceptions\UnauthorizedException $e, $request) {
//            return response()->json([
//                                        'responseMessage' => 'You do not have the required authorization.',
//                                        'responseStatus'  => 403,
//                                    ]);
//        });
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return api_response(null , __("You must be loginned"), 'Unauthenticated .' , 401);
        }

        return redirect()->guest(route('login'));
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            return abort('503');
        }
        if ($request->wantsJson()) {
            if ($exception instanceof ValidationException) {
                $errors = $exception->errors();
                $message = "";
                foreach ($errors as $key => $error) {
                    $myerrors[$key] = $message = $error[0];
                }
                return api_response(null , $message  ,1)->setStatusCode(401);
            } elseif ($exception instanceof NotFoundHttpException) {
                return api_response(null , 'This url not found please check it again', 'error')->setStatusCode(401);
            } elseif ($exception instanceof MethodNotAllowedHttpException) {
                return api_response(null , $exception->getMessage(),'error')->setStatusCode(401);
            } elseif ($exception instanceof BadMethodCallException) {
                return api_response(null , $exception->getMessage(), 'error')->setStatusCode(401);
            }
            elseif ($exception instanceof AuthenticationException) {
              return api_response(null , __("You must be loginned"), 'Unauthenticated .' , 401);
             }
            elseif ($exception instanceof ModelNotFoundException) {
                return api_response(null , $exception->getMessage(), 'error')->setStatusCode(401);
            }
        } elseif (strpos(request()->url(), '/') == false &&
                  ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException)) {
            return response()->view('Common::404', ['type' => 404]);
        }
        return parent::render($request, $exception);
    }

}
