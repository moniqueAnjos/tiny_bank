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

    private function formatResponse($msg, $statuscode, $result, $errors = '')
    {
        $arrayReturn = [
            'message' => $msg,
            'statusCode' => $statuscode,
            "result" => $result
        ];
        if ($errors != '') {
            $arrayReturn["errors"] = $errors;
        }
        return response()->json(
            $arrayReturn,
            $statuscode
        );
    }


    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return $this->formatResponse(
                'Ação não autorizada.',
                Response::HTTP_FORBIDDEN,
                false
            );
        }
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return $this->formatResponse(
                'Registro ' . str_replace('App\\', '', $exception->getModel()) . ' não encontrado',
                Response::HTTP_NOT_FOUND,
                false
            );
        }
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return $this->formatResponse(
                'Erro na validação de campo.',
                Response::HTTP_UNPROCESSABLE_ENTITY,
                false,
                $exception->errors()
            );
        }
        return $this->formatResponse(
            $exception->getMessage(),
            $exception->getCode(),
            false
        );
    }
}
