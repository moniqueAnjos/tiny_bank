<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        \InvalidArgumentException::class,
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
    // public function register()
    // {
    //     $this->reportable(function (Throwable $e) {
    //         //
    //     });
    // }

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }


    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return response()->json(
                [
                    'message' => 'Ação não autorizada.',
                    'statusCode' => Response::HTTP_FORBIDDEN,
                    "result" => false
                ],
                Response::HTTP_FORBIDDEN
            );
        }
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->json([
                'message' => 'Registro ' . str_replace('App\\', '', $exception->getModel()) . ' não encontrado',
                'statusCode' => Response::HTTP_NOT_FOUND,
                "result" => false
            ], Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return response()->json([
                'message' => 'Erro na validação de campo.',
                'statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'errors' => $exception->errors(),
                "result" => false
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'message' => $exception->getMessage(),
            'statusCode' => $exception->getCode(),
            "result" => false
        ], 422);
    }
}
