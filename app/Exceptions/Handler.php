<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;



class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $exception) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */

    // If the exception is an instance of ValidationException, we can return a JSON response with the validation errors. Otherwise, the exception will be handled by the parent render() method, which can return an appropriate HTML response.
    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return response()->json(['errors' => $e->errors()], 400);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json(['error' => $e->getMessage()], 404);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json(['error' => 'Resource not found'], 404);
        }

        if ($e instanceof RouteNotFoundException) {
            return response()->json(['error' => $e->getMessage()], 404);
        }



        return parent::render($request, $e);
    }

}
