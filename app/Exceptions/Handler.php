<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->ajax() || $request->wantsJson())
        {
            $success = false;
            $status = '';
            $errors = [];
            $json = [
                'success' => $success,
                'code' => $exception->getCode(),
                'errors' => [],
            ];
            if (isset($exception->validator)){
                $success = false;
                $status = 200;
                $json['success'] = $success;
                foreach ($exception->errors() as $field => $message){
                    $errors[] = [
                        'field' => $field,
                        'message' => $message[0],
                    ];
                }
            }
            else {
                $errors[] = [
                    'field' => '',
                    'message' => $exception->getMessage(),
                ];
            }
            $json['errors'] = $errors;
            if (!$status){
                if (isset($exception->status)){
                    $status = $exception->status;
                }
                else {
                    $status = 200;
                }
            }
            return response()->json($json, $status);
        }
        return parent::render($request, $exception);
    }
}
