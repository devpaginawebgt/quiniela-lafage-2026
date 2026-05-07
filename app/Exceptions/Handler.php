<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (ValidationException $e, $request)
        {

            if ($request->expectsJson()) {

                $error = $e->validator->errors()->first();

                return $this->errorResponse($error, 422, $e->errors(), 'INVALID_PAYLOAD');

            }

        });

        $this->renderable(function (AccessDeniedHttpException $e, $request)
        {

            if ($request->expectsJson()) {

                $previous   = $e->getPrevious();
                $error_code = $previous instanceof AuthorizationException && $previous->getCode() !== 0
                    ? (string) $previous->getCode()
                    : null;

                return $this->errorResponse($e->getMessage() ?: 'Acceso denegado.', 403, [], $error_code);

            }

        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ( $request->expectsJson() ) {

            return $this->errorResponse('Acceso no autorizado. Inicie sesión.', 401);

        }

        return redirect()->guest(route('ingresa'));
    }
}
