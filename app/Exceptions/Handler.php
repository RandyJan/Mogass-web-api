<?php

namespace App\Exceptions;
use Throwable;
use Illuminate\Support\Str;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
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
    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson() && Str::contains($exception->getMessage(), 'Unauthenticated.')) {
            return response()->json([
                'StatusCode' => 401,
                'StatusDescription' => 'Unauthorized',
                'Data' => [],
                'Message' => 'Invalid token'
            ], 401);
        }

        return parent::unauthenticated($request, $exception);
    }

}
